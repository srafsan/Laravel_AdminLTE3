<?php

class Fish {
    public function swim()
    {
        return 'swimming';
    }

    public function eat()
    {
        return 'eating';
    }
}

app()->bind('fish', function () {
    return new Fish();
});

//$fish = new Fish();
//dd($fish->swim());

class Bike {
    public function start()
    {
        return 'starting';
    }
}

app()->bind('bike', function() {
    return new Bike();
});

class Facade {
    public static function __callStatic($name, $args)
    {
        return app()->make(static::getFacadeAccessor())->$name();
    }

//    protected static function getFacadeAccessor()
//    {
//
//    }
}

class FishFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'fish';
    }
}
class BikeFacade extends Facade{
    protected static function getFacadeAccessor()
    {
        return 'bike';
    }
}


//dd(FishFacade::eat());
