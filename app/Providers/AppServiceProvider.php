<?php

namespace App\Providers;

use App\Adapters\DataProviderXAdapter;
use App\Adapters\DataProviderYAdapter;
use App\Adapters\DataProviderAdapter;
use Illuminate\Support\ServiceProvider;
use App\Interfaces\AdapterInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AdapterInterface::class, function ($app) {
            switch ($app->make('config')->get('services.service-provider')) {
                case 'data-provider-x':
                    return new DataProviderXAdapter();
                case 'data-provider-y':
                    return new DataProviderYAdapter();
                default:
                    return new DataProviderAdapter(new DataProviderXAdapter, new DataProviderYAdapter);
            }
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
