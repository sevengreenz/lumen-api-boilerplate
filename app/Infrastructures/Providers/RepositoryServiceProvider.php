<?php

namespace App\Infrastructures\Providers;

use App\Adapters\Gateways\SampleRepository;
use App\Domain\Repositories\SampleRepository as SampleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(SampleRepositoryInterface::class, SampleRepository::class);
    }
}
