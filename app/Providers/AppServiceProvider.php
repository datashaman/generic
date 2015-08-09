<?php

namespace App\Providers;

use Elasticsearch\ClientBuilder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $es = $this->app->make('elasticsearch');

        if ($es->cat()->health() && $es->indices()->exists([ 'index' => 'generic' ])) {
            $response = $es->get([ 'index' => 'generic', 'type' => 'menu', 'id' => 'main' ]);
            $menuMain = $response['_source'];
        } else {
            $menuMain = [ 'items' => []];
        }

        view()->share('menuMain', $menuMain);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('elasticsearch', function () {
            return ClientBuilder::create()->build();
        });
    }
}
