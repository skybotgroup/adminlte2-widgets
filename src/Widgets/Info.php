<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

class Info extends Widget
{
    protected $view = 'adminlte2-widgets::info.info';

    /**
     * @var string
     */
    protected $text;
    /**
     * @var float
     */
    protected $number;
    /**
     * @var string
     */
    protected $icon;
    /**
     * @var mixed|string
     */
    protected $iconBg;
    /**
     * @var array
     */
    protected $progress = [];

    /**
     * Info constructor.
     * @param string $text
     * @param float $number
     * @param string $color
     * @param string $icon
     * @param string $iconBg
     * @param float $progress
     * @param string $description
     */
    public function __construct(string $text, float $number, string $color = "primary", string $icon = "info", string $iconBg = "", float $progress = -1, string $description = "")
    {
        $this->class("info-box");
        $this->text = $text;
        $this->number = $number;
        $this->color($color);
        $this->icon($icon, $iconBg);
        if ($progress >= 0){
            $this->progress($progress, $description);
        }
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
     * @param array|string $classes
     * @return $this
     */


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
            'attributes' => $this->formatAttributes()
        ];

        return view($this->view, $variables)->render();
    }
}