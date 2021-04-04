<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Encore\Admin\Widgets\Widget;
use Illuminate\Contracts\Support\Renderable;

class Bloquote extends Widget implements Renderable
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
            'attributes' => $this->formatAttributes()
        ];

        return view($this->view, $variables)->render();
    }
}