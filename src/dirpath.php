<?php

namespace wulfheart\lxcd;

class dirpath
{

    private $parent;

    private $base_url;

    private $bricks;

    private $base_filesystem;

    public function __construct(string $base_url, string $dir, string $base_filesystem = null)
    {
        $this->base_url = $base_url;
        $xplosion = explode('/', $dir);
        $this->bricks = (!empty($xplosion)) ? $xplosion : [];
        $this->base_filesystem = $base_filesystem;
    }

    public function is_top()
    {
        if (count($this->bricks) <= 1 && empty($this->bricks[0])) {
            return true;
        }
        return false;
    }

    public function current()
    {
            return trim($this->base_url . '/' . implode('/', $this->bricks), '/');
        
    }

    public function fs_current(){
        return $this->base_filesystem;
    }

    public function parent()
    {
        if (!$this->is_top()) {
            return $this->base_url . '/' . implode('/', array_slice($this->bricks, 0, count($this->bricks) - 1));
        }
        return 0;
    }

    public function child(string $child)
    {
        return $this->current() . "/" . $child;
    }
}
