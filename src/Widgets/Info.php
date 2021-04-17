<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

/**
 * Class Info
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Info extends Widget
{
    protected $view = 'adminlte2-widgets::info.info';

    protected $text;
    protected $number;
    protected $icon;
    protected $iconBg;
    protected $progress = [];

    /**
     * Info constructor.
     * @param string $text
     * @param float $number
     */
    public function __construct(string $text, float $number)
    {
        $this->class("info-box");
        $this->text = $text;
        $this->number = $number;
        $this->icon("users");
        parent::__construct();
    }

    /**
     * @param string $color
     * @return $this
     */
    public function color(string $color): Info
    {
        $this->class("bg-$color");
        return $this;
    }

    /**
     * @param string $icon
     * @param string $iconBg
     * @return $this
     */
    public function icon(string $icon, string $iconBg = ""): Info
    {
        $this->icon = $icon;
        $this->iconBg = $iconBg;
        return $this;
    }

    /**
     * @param float $progress
     * @param string $description
     * @return $this
     */
    public function progress(float $progress, string $description = ""): Info
    {
        $this->progress = [
            'percent' => $progress,
            'description' => $description
        ];
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function render() : string
    {
        $variables = [
            'text' => $this->text,
            'number' => $this->number,
            'icon' => $this->icon,
            'iconBg' => $this->iconBg,
            'progress' => $this->progress,
            'attributes' => $this->formatClasses()
        ];

        return view($this->view, $variables)->render();
    }
}