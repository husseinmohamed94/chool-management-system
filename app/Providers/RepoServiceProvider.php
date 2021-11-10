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
       $this->app->bind(
                'App\Repository\ReceiptStudentsRepositoryInterface',
                'App\Repository\ReceiptStudentsRepository',
        );
       $this->app->bind(
                'App\Repository\ProcessingFeeRepositoryInterface',
                'App\Repository\ProcessingFeeRepository',
        );
       $this->app->bind(
                'App\Repository\PaymentRepositoryInterface',
                'App\Repository\PaymentRepository',
        );
       $this->app->bind(
                'App\Repository\AttendanceRepositoryInterface',
                'App\Repository\AttendanceRepository',
        );
       $this->app->bind(
                'App\Repository\subjectRepositoryInterface',
                'App\Repository\subjectRepository',
        );
       $this->app->bind(
                'App\Repository\QuizzeRepositoryInterface',
                'App\Repository\QuizzeRepository',
        );
       $this->app->bind(
                'App\Repository\QuestionRepositoryInterface',
                'App\Repository\QuestionRepository',
        );
       $this->app->bind(
                'App\Repository\OnlineClassesRepositoryInterface',
                'App\Repository\OnlineClassesRepository',
        );
       $this->app->bind(
                'App\Repository\LibraryRepositoryInterface',
                'App\Repository\LibraryRepository',
        );

    }
}
