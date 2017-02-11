<?php

namespace SeoMax\MiniToastr;

use Illuminate\Support\ServiceProvider;

class MiniToastrServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mini-toastr', function ($app) {
        	return new MiniToastr($app);
		});
    }
}
