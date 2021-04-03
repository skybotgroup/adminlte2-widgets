<?php

use Skybotgroup\ALTE2Widgets\Http\Controllers\ALTE2WidgetsController;

Route::get('phpinfo', ALTE2WidgetsController::class.'@index');