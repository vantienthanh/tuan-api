<?php

namespace Modules\Review\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Review\Events\Handlers\RegisterReviewSidebar;

class ReviewServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterReviewSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('companies', array_dot(trans('review::companies')));
            $event->load('reviews', array_dot(trans('review::reviews')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('review', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Review\Repositories\CompanyRepository',
            function () {
                $repository = new \Modules\Review\Repositories\Eloquent\EloquentCompanyRepository(new \Modules\Review\Entities\Company());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Review\Repositories\Cache\CacheCompanyDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Review\Repositories\ReviewRepository',
            function () {
                $repository = new \Modules\Review\Repositories\Eloquent\EloquentReviewRepository(new \Modules\Review\Entities\Review());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Review\Repositories\Cache\CacheReviewDecorator($repository);
            }
        );
// add bindings


    }
}
