<?php

namespace Iutrace\Botmaker\Facades;

use Illuminate\Support\Facades\Facade;

class Botmaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'botmaker';
    }
}