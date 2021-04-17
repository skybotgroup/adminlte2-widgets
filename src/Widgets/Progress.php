<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

/**
 * Class Progress
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Progress extends Widget
{
    protected $view = "adminlte2-widgets::progress.progress";

    protected $percent;
    protected $description;
    protected $color;
    protected $active = false;
    protected $vertical = false;

    /**
     * Progress constructor.
     * @param float $percent
     * @param string $description
     * @param string $color
     */
    public function __construct(float $percent, string $description = "", string $color = 'green')
    {
        $this->class("progress");
        $this->percent = $percent;
        $this->description = $description;
        $this->color = $color;
        parent::__construct();
    }

    /**
     * @return $this
     */
    public function active(): Progress
    {
        $this->class("active");
        $this->active = true;
        return $this;
    }

    /**
     * @return $this
     */
    public function vertical(): Progress
    {
        $this->class("vertical");
        $this->vertical = true;
        return $this;
    }

    /**
     * @param string $size
     * @return $this
     */
    public function size(string $size): Progress
    {
        $this->class("progress-$size");
        return $this;
    }

    public function render(): string
    {
        $variables = [
            'progress' => [
                "percent" => $this->percent,
                "description" => $this->description,
            ],
            'color' => $this->color,
            'attributes' => $this->formatClasses(),
            'active' => $this->active,
            'vertical' => $this->vertical,
        ];

        return view($this->view, $variables)->render();
    }
}