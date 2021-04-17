<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

/**
 * Class Bloquote
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Bloquote extends Widget
{
    protected $view = 'adminlte2-widgets::blockquote.blockquote';

    protected $quote = "";
    protected $cite = "";

    /**
     * Bloquote constructor.
     * @param $quote
     * @param $cite
     */
    public function __construct($quote, $cite)
    {
        $this->quote = $quote;
        $this->cite = $cite;
        parent::__construct();
    }

    /**
     * @return $this
     */
    public function pullRight(): Bloquote
    {
        $this->class('pull-right');
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $variables = [
            'quote' => $this->quote,
            'cite' => $this->cite,
            'attributes' => $this->formatClasses(),
        ];
        return view($this->view, $variables)->render();
    }
}