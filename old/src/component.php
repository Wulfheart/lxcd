<?php

namespace wulfheart\lxcd;

use Illuminate\Support\Facades\Log;
use ReflectionClass;


class component
{

    private $name;

    private $basepath;

    private $extension;

    private $app_namespace;

    public $label;

    public $description;

    public $params;


    public function __construct(string $name, string $basepath, string $app_namespace)
    {
        $x = explode('.', $name);
        $this->name = $x[0];
        $this->basepath = $basepath;
        $this->app_namespace = $app_namespace;
        $this->params = [];
        $this->get_doc();
        // dd($this);
    }

    public function full_path()
    {
        return $this->basepath . $this->name . '.php';
    }

    public function full_class()
    {
        return $this->app_namespace . '\\' . $this->name;
    }

    public function get_doc()
    {
        $reflector = new ReflectionClass($this->full_class());
        $block = $reflector->getMethod('__construct')->getDocComment();;

        $factory  = \phpDocumentor\Reflection\DocBlockFactory::createInstance();
        $docblock = $factory->create($reflector->getMethod('__construct')->getDocComment());

        // Assign label
        $this->label = $docblock->getSummary();
        // Assign description
        $this->description = helpers::getDescription($docblock->getDescription());
        // Do the tag magic
        if ($docblock->hasTag('param')) {
            foreach ($docblock->getTagsByName('param') as $param) {
                array_push($this->params, new param($param));
            }
        }
        // Sort required up and not required down
        usort($this->params, function($a, $b){
            return $b->required() - $a->required();
        });
    }

}
