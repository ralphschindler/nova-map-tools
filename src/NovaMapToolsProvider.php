<?php

namespace RalphSchindler\NovaMapTools;

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class NovaMapToolsProvider extends ServiceProvider
{
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('map-tools', __DIR__ . '/../dist/nova-map-tools.js');
            // Nova::style('map-tools', __DIR__ . '/../dist/nova-map-tools.css');
            // Nova::style('map-tool/marker-icon.png', __DIR__ . '/../dist/images/vendor/leaflet/dist/marker-icon.png');

        });

        $this->publishes([
            __DIR__ . '/../dist/images/vendor/leaflet/dist/' => public_path('vendor/nova-map-tools'),
        ], 'public');

        // Route::group(
        //     ['middleware' => 'nova', 'prefix' => 'nova-vendor/select-plus', 'namespace' => __NAMESPACE__],
        //     function ($route) {
        //         $route->get('/{resource}/{relationship}', 'Controller@options');
        //     }
        // );
    }
}
