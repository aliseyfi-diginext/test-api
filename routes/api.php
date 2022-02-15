<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('task', 'TaskController')->middleware('custom_api');

Route::post('answers/get', 'AnswerController@get');
Route::post('answers/save', 'AnswerController@save');
