<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['prefix' => 'student'], function () {

    Route::post('/register', 'Student\AuthController@register');
    Route::post('/login', 'Student\AuthController@login');

    Route::get('/email/resend', 'Student\VerificationController@resend')->name('verification.resend');
    Route::get('/email/verify/{id}/{hash}', 'Student\VerificationController@verify')->name('verification.verify');

    Route::post('/password/reset/create', 'Student\PasswordResetController@create');
    Route::get('/password/reset/{token}', 'Student\PasswordResetController@find');
    Route::post('/password/reset', 'Student\PasswordResetController@reset');
    Route::get('/details', 'Student\AuthController@studentDetails');
});

Route::group(['prefix' => 'tutor'], function () {

    Route::post('/register', 'Tutor\AuthController@register');
    Route::post('/login', 'Tutor\AuthController@login');
    Route::post('/quizpack/create', 'Tutor\QuizpackController@create');
    Route::post('/quizpack/{quizpack}/question', 'Tutor\QuizpackController@addQuestion');
    Route::put('/quizpack/{quizpack}/question/{question}', 'Tutor\QuizpackController@updateQuestion');
    Route::delete('/quizpack/{quizpack}/question/{question}', 'Tutor\QuizpackController@deleteQuestion');
    Route::get('/quizpacks', 'Tutor\QuizpackController@tutorQuizpacks');
    Route::put('/quizpack/{quizpack}', 'Tutor\QuizpackController@updateQuizpack');
    Route::delete('/quizpack/{quizpack}', 'Tutor\QuizpackController@deleteQuizpack');


});
Route::get('/quizpack/{quizpack}/questions', 'Tutor\QuizpackController@questions');

Route::get('/login/{service}', 'SocialLoginController@redirect');
Route::get('/login/{service}/callback', 'SocialLoginController@callback');
Route::post('/updateNewSocialAccount', 'SocialLoginController@update');

Route::get('/programs', 'ProgramController@index');
