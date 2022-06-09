<?php

namespace App\Providers;

use App\Test;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind("test",function(){ // bind or singleton
            return new Test("Moe Lay");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() // bind လုပ်ပြီးသွားရင် လိုချင်တဲ့ function/ logic code တွေ ရေး။
    {
        //
    }
}
