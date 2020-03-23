<?php

use wulfheart\lxcd\dirpath;
use wulfheart\lxcd\component;


Route::prefix('lxcd')->namespace('lxcd')->middleware('web')->group(function () {
    Route::get('{path?}', function ($path = null) {
        $LXCD_COMPONENTS_NAMESPACE = env('LXCD_COMPONENTS_NAMESPACE', 'App\View\Components');
        $LXCD_COMPONENTS_PATH = trim(env('LXCD_COMPONENTS_PATH', realpath(dirname(__FILE__) . '/../../../../App/View/Components')), '\/');
        $base =realpath($LXCD_COMPONENTS_PATH);
        $dir = realpath($base . '/' . $path);
        $namespace = $LXCD_COMPONENTS_NAMESPACE;

        if (!empty($path)) {
            $namespace = $LXCD_COMPONENTS_NAMESPACE . '\\' . str_replace("/", "\\", $path);
        }
        try {
            $scandir = scandir($dir);
        } catch (\Throwable $th) {
            abort(404, 'Cannot get the contents of the directory.');
        }
        $content = array_map(null, array_diff($scandir, array('.', '..')));

        sort($content, SORT_NATURAL);

        $dirurl = new dirpath('lxcd', $path ?? '', $LXCD_COMPONENTS_PATH);


        // ! Assumption: Two types of content:
        // ! Ending .php: Component
        // ! Without ending: Folder
        $folders = [];
        $components = [];
        foreach ($content as $object) {
            $x = explode('.', $object);
            if (count($x) == 2 && $x[1] == 'php') {
                // Hey, it's a component. 🤗
                array_push($components, new component($object, $dirurl->fs_current(), $namespace));
            } else if (count($x) == 1) {
                // Well, it is a folder 📁
                array_push($folders, $object);
            }
        }

        return view("lxcd::dir", [
            'dirurl' => $dirurl,
            'folders' => $folders,
            'components' => $components

        ]);
    })->where('path', '(.*)');
});
