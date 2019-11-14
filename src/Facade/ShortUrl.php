<?php

namespace ShortUrl\Facade;

use ShortUrl\ShortUrl as Accessor;
use think\Facade;

class ShortUrl extends Facade
{
    protected static function getFacadeClass()
    {
        return Accessor::class;
    }
}
