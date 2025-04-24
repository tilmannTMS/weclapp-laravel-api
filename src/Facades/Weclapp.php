<?php

namespace TilmannTMS\Weclapp\Facades;

use Illuminate\Support\Facades\Facade;

class Weclapp extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'weclapp';
    }
}