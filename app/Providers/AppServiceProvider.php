<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
       /* DB::listen(function($sql) {
            //var_dump($sql);
            echo("<br/>");
           echo( vsprintf(str_replace('?', '%s', $sql->sql), $sql->bindings));
          
           // var_dump($sql->time);
        });*/
    }
}
