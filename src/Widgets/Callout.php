<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

class Callout extends Widget
{
    protected $view = 'adminlte2-widgets::callout.callout';

    protected $title = "";
    protected $body = "";

    /**
     * Bloquote constructor.
     * @param $title
     * @param $body
     * @param string $color
     * Available colors :
     * - primary
     * - info
     * - success
     * - warning
     * - danger
     * - gray
     * - navy
     * - teal
     * - purple
     * - orange
     * - maroon
     * - black
     */
    public function __construct($title, $body, string $color)
    {
        $this->class("callout");
        $this->class("callout-".$color);

        $this->title = $title;
        $this->body = $body;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $variables = [
            'title' => $this->title,
            'body' => $this->body,
            'attributes' => $this->formatAttributes()
        ];

        return view($this->view, $variables)->render();
    }
}