<?php

namespace wulfheart\lxcd;

class helpers{
    public static function getDescription(\phpDocumentor\Reflection\DocBlock\Description $description){
        $args = array_fill(0, count($description->getTags()), null);
        $body = vsprintf($description->getBodyTemplate(), $args);
        return trim($body);
    }
}
