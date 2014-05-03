<?php namespace Opb\LaravelTxtlocal;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Config;

class LaravelTxtlocalServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('opb/laravel-txtlocal');
	}

	/**
	 * Register the service provider.
	 * 
	 * @return void
	 */
	public function register()
	{
        $this->app['laravel-txtlocal'] = $this->app->share(function($app)
        {
        	$apiKey = Config::get('laravel-txtlocal::apiKey');
        	$from = Config::get('laravel-txtlocal::from');
        	$testMode = Config::get('laravel-txtlocal::testMode');
            return new LaravelTxtlocal(new Client, $apiKey, $from, $testMode);
        });

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('laravel-txtlocal');
	}

}