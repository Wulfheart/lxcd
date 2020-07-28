<?php

namespace Wulfheart\Lxcd;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wulfheart\Lxcd\Lxcd
 */
class LxcdFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'lxcd';
    }
}
