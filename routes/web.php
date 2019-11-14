<?php

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

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/admin', function () {
    return view('admin');
});
*/
/*
Route::get('/admin', function () {

    return 'admin';
});
*/

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){

    //Route::resource('surveys', 'SurveyController');

    Route::get('surveys', 'SurveyController@index');

    Route::get('/', 'SurveyController@admin');

    Route::get('surveys/create', 'SurveyController@create');
    Route::post('surveys/create', 'SurveyController@store');

    Route::get('surveys/edit/{id}', 'SurveyController@edit');
    Route::post('surveys/edit/{id}', 'SurveyController@update');

    Route::get('surveys/delete/{id}', 'SurveyController@delete');

    Route::get('surveys/contact/{id}', 'SurveyController@contact');

    Route::get('surveys/addreponse/{id}', 'SurveyController@addreponse');
    Route::post('surveys/addreponse/{id}', 'SurveyController@storereponse');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/questionnaire/{id}', 'QuestionnaireController@index');
Route::post('/questionnaire/save', 'QuestionnaireController@save');
Route::post('/questionnaire/valid', 'QuestionnaireController@valid');

