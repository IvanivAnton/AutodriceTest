<?php

namespace App\Providers;

use App\Domain\Interfaces\AutoCatalogXmlParserServiceInterface;
use App\Domain\Interfaces\EngineTypeServiceInterface;
use App\Domain\Interfaces\GearTypeServiceInterface;
use App\Domain\Interfaces\TransmissionServiceInterface;
use App\Domain\UseCases\UpdateAutoCatalog;
use App\Domain\UseCases\UpdateAutoCatalogInputInterface;
use App\Service\AutoCatalogXmlParserService;
use App\Service\EngineTypeService;
use App\Service\GearTypeService;
use App\Service\TransmissionService;
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
        $this->app->bind(AutoCatalogXmlParserServiceInterface::class, AutoCatalogXmlParserService::class);
        $this->app->bind(EngineTypeServiceInterface::class, EngineTypeService::class);
        $this->app->bind(GearTypeServiceInterface::class, GearTypeService::class);
        $this->app->bind(TransmissionServiceInterface::class, TransmissionService::class);
        $this->app->bind(UpdateAutoCatalogInputInterface::class, UpdateAutoCatalog::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
