<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (App::environment("production")) {
            Request::macro('hasValidSignature', function ($absolute = true) {
                if ('livewire/upload-file' == request()->path()) {
                    return true;
                }
                return URL::hasValidSignature($this, $absolute);
            });
        }
    }

    public function boot(): void
    {
        if (App::environment("production")) {
            URL::forceScheme("https");
        }
    }
}
