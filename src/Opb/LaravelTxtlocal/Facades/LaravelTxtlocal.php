<?php namespace Opb\LaravelTxtlocal\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelTxtlocal extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() 
    { 
    	return 'laravel-txtlocal'; 
    }

}