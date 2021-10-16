<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware'=> ['guest']],function (){

    Route::get('/', function()
    {
        return view('auth.login');
    });

});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //***************************** Grades ***********************

    Route::group(['namespace'=> 'Grades'],function (){
        Route::resource('Grades', 'GradeController');

    });
    //***************************** Classroom ***********************

    Route::group(['namespace'=> 'Classroom'],function (){
        Route::resource('classroom', 'ClassroomController');
        Route::post('dletet_all', 'ClassroomController@dletet_all')->name('dletet_all');
        Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');

    });
    //***************************** Section ***********************
    Route::group(['namespace'=> 'Section'],function (){
        Route::resource('Section', 'SectionController');

        Route::get('classes/{id}','SectionController@getclasses');

    });

  /*  Route::group(['namespace'=> 'MyParents'],function (){
        Route::resource('MyParents', 'MyParentController');
    });*/

    //***************************** Parent ***********************

    Route::view('add_Parent','livewire.show_Form');
    //***************************** Teachers ***********************
    Route::group(['namespace'=> 'Teachers'],function (){
        Route::resource('Teachers', 'TeacherController');

    });
    Route::group(['namespace'=> 'Students'],function (){
        Route::resource('Students', 'StudentController');
        Route::get('/Get_classrooms/{id}','StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}','StudentController@Get_Sections');
        Route::post('Upload_attachment','StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentname}/{filename}','StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment','StudentController@Delete_attachment')->name('Delete_attachment');

        Route::resource('promotion', 'promotionController');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('Fee', 'FeeController');
        Route::resource('FeeInvoices', 'FeeInvoiceController');
        Route::resource('ReceiptStudents', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('PaymentSudents', 'PaymentController');
        Route::get('/Get_amount/{id}','FeeInvoiceController@Get_amount');
        Route::resource('Attendance', 'AttendanceController');

    });


    Route::group(['namespace'=> 'Subjects'],function (){
        Route::resource('Subject', 'SubjectController');

    });
    Route::group(['namespace'=> 'Quizzs'],function (){
        Route::resource('Quizzs', 'QuizzController');

    });
    Route::group(['namespace'=> 'Question'],function (){
        Route::resource('questions', 'QuestionController');

    });


});









