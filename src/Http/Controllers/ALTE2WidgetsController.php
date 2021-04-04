<?php

namespace Skybotgroup\ALTE2Widgets\Http\Controllers;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Routing\Controller;
use Skybotgroup\ALTE2Widgets\Widgets\Accordion;
use Skybotgroup\ALTE2Widgets\Widgets\Bloquote;
use Skybotgroup\ALTE2Widgets\Widgets\Callout;
use Skybotgroup\ALTE2Widgets\Widgets\Info;
use Skybotgroup\ALTE2Widgets\Widgets\Progress;

class ALTE2WidgetsController extends Controller
{
    /**
     * @param Content $content
     * @return mixed
     *
     * Route with demo
     */
    public function index(Content $content)
    {
        return $content
            ->title('Title')
            ->description('Description')
            ->row(function (Row $row){
                $row->column(6, new Box(
                    "Accordion",
                    (new Accordion())->append(
                        "Text 1",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
                    )->append(
                        "Text 2",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                        "success"
                    )->append(
                        "Text 3",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                        "danger"
                    )->append(
                        "Text 4",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                        "warning"
                    )
                ));
                $row->column(6, new Box(
                    "Blockquote",
                    new Bloquote(
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "Cool man"
                    )
                ));
                $row->column(6, new Box(
                    "Blockquote",
                    (new Bloquote(
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.",
                        "Cool man"
                    ))->pullRight()
                ));
                $row->column(6, new Box(
                    "Callout",
                    new Callout(
                        "Test",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                        "warning"
                    )
                ));
                $row->column(6, new Box(
                    "Callout",
                    new Callout(
                        "Test",
                        "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. 
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. 
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                        "success"
                    )
                ));
                $row->column(6, new Box(
                    "Info",
                    (new Info(
                        "Text",
                        12
                    ))->color(
                        "success"
                    )->icon(
                        "users"
                    )->progress(12, "12% of users")
                ));
                $row->column(6, new Box(
                    "Progress",
                    new Progress(12, "Hello world", "blue")
                ));
                $row->column(6, new Box(
                    "Slider",
                    ""
                ));
                $row->column(6, new Box(
                    "SmallBox",
                    ""
                ));
                $row->column(12, new Box(
                    "Timeline",
                    ""
                ));
            });
    }
}