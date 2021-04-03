<?php

namespace Skybotgroup\ALTE2Widgets\Http\Controllers;

use Encore\Admin\Layout\Content;
use Illuminate\Routing\Controller;

class ALTE2WidgetsController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->body(view('adminlte2-widgets::index'));
    }
}