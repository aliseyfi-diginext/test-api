<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['cors', 'custom_api'])->group(function () {
    Route::apiResource('task', 'TaskController');
    Route::post('answers/get', 'AnswerController@get');
    Route::post('answers/save', 'AnswerController@save');
});
