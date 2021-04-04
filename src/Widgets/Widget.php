<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Illuminate\Contracts\Support\Renderable;

class Widget extends \Encore\Admin\Widgets\Widget implements Renderable
{
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

        $this->attributes["class"] =
            (
            isset($this->attributes["class"])
            && !empty($this->attributes["class"])
                ? $this->attributes["class"]." "
                : ""
            ).implode(" ", $classes);
        return $this;
    }
}