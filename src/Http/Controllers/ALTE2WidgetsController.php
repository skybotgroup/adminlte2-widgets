<?php

namespace Skybotgroup\ALTE2Widgets\Http\Controllers;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Illuminate\Routing\Controller;
use Skybotgroup\ALTE2Widgets\Widgets\Accordion;

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
                    ""
                ));
                $row->column(6, new Box(
                    "Callout",
                    ""
                ));
                $row->column(6, new Box(
                    "Info",
                    ""
                ));
                $row->column(6, new Box(
                    "Progress",
                    ""
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