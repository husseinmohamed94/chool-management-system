<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository',);
        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
                  'App\Repository\StudentRepository',
        );
        $this->app->bind(
            'App\Repository\StudentPoromtionRepositoryInterface',
                  'App\Repository\StudentPoromtionRepository',
        );
        $this->app->bind(
            'App\Repository\GraduatedStudenRepositoryInterface',
                  'App\Repository\GraduatedStudenRepository',
        );
        $this->app->bind(
            'App\Repository\FeesRepositoryInterface',
                  'App\Repository\FeesRepository',
        );
       $this->app->bind(
                'App\Repository\FeeInvoiceRepositoryInterface',
                'App\Repository\FeeInvoiceRepository',
        );

       $this->app->bind(
                'App\Repository\StudentAccountRepositoryInterface',
                'App\Repository\StudentAccountRepository',
        );
    }
}
