<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

/**
 * Class Callout
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
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
     */
    public function __construct($title, $body, string $color)
    {
        $this->class("callout");
        $this->class("callout-".$color);

        $this->title = $title;
        $this->body = $body;
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $variables = [
            'title' => $this->title,
            'body' => $this->body,
            'attributes' => $this->formatClasses()
        ];

        return view($this->view, $variables)->render();
    }
}