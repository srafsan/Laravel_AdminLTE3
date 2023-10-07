<?php

namespace App;

class Postcard
{
    protected static function resolveFacade($name)
    {
        return app()->make($name);
    }
    public static function __callStatic($method, $arguments)
    {
        //dd($method);
        return (self::resolveFacade('Postcard'))
            ->$method(...$arguments);
    }
}
