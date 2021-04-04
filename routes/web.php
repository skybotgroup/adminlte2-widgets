<?php

use Skybotgroup\ALTE2Widgets\Http\Controllers\ALTE2WidgetsController;

Route::get('widgets-demo', ALTE2WidgetsController::class.'@index');