<?php namespace Opb\LaravelTxtlocal;

use Illuminate\Support\ServiceProvider;

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
            return new LaravelTxtlocal;
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