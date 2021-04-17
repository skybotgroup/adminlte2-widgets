<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Illuminate\Contracts\Support\Renderable;

/**
 * Class Widget
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Widget extends \Encore\Admin\Widgets\Widget implements Renderable
{
    public $classes = [];

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        return view($this->view)->render();
    }

    /**
     * @param $classes
     * @return $this
     */
    public function class($classes): Widget
    {
        if (is_string($classes)) {
            return $this->class([$classes]);
        }

        $this->classes = array_merge($classes, $this->classes);
        return $this;
    }

    /**
     * @return string
     */
    public function formatClasses() : string
    {
        $classString = implode(" ", $this->classes);
        return "class='$classString'";
    }
}