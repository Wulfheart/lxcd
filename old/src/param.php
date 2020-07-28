<?php

namespace wulfheart\lxcd;

use Illuminate\Support\Facades\Log;

class param
{
    public $name;
    public $type;
    public $description;
    public $default;

    public function __construct(\phpDocumentor\Reflection\DocBlock\Tags\Param $param){
        $this->name = $param->getVariableName();
        $this->type = sprintf($param->getType());
        $this->description = helpers::getDescription($param->getDescription());
        foreach ($param->getDescription()->getTags() as $tag) {
            if ($tag->getName() == 'default') {
                $this->default = helpers::getDescription($tag->getDescription());
            }
        }
    }

    public function required(){
        return empty($this->default);
    }
}
