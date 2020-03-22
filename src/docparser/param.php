<?php

namespace wulfheart\lxcd\docparser;

class Param
{
    public function __construct(string $tagline)
    {
        $bricks = explode("  ", $tagline);
        dd($bricks);
    }
}
