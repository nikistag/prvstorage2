<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        $disk_free_space = round(disk_free_space(config('filesystems.disks.local.root')) / 1073741824, 2);
        $disk_total_space = round(disk_total_space(config('filesystems.disks.local.root')) / 1073741824, 2);
        $quota = round(($disk_total_space - $disk_free_space) * 100 / $disk_total_space, 0);
        view()->share('disk_free_space',  $disk_free_space);
        view()->share('disk_total_space',  $disk_total_space);
        view()->share('quota',  $quota);
    }
}
