<?php
/*
 * Copyright (c) 2022 by bHosted.nl B.V.  - All rights reserved
 */

namespace Mvdgeijn\Halon;

use Illuminate\Support\ServiceProvider;

class HalonServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../../config/config.php', 'halon');

        $this->app->singleton(\Mvdgeijn\Halon\Cluster::class, function() {
            return \Mvdgeijn\Halon\Cluster::get();
        });
    }

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
