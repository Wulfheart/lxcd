<?php

namespace wulfheart\lxcd\docparser;

class Helpers
{
    public static function has_prefix($string, $prefix)
    {
        return substr($string, 0, strlen($prefix)) == $prefix;
    }
}
