<?php

namespace Cblink\Yilianyun;

class LaravelServiceProvider extends \Illuminate\Support\ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton(Application::class, function(){
            return new Application(config('services.yilianyun'));
        });

        $this->app->alias(Application::class, 'yilianyun');
    }

    public function provides()
    {
        return [Application::class, 'weather'];
    }
}