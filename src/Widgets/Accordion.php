<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;

/**
 * Class Accordion
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Accordion extends Widget
{
    protected $view = 'adminlte2-widgets::accordion.accordion';

    protected $id = "";
    protected $rows = [];

    public function __construct($attributes = [])
    {
        $this->id = Str::random();
        parent::__construct($attributes);
    }

    /**
     * @param string $title
     * @param mixed $content
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
     * @return $this
     *
     * Appends new collapsable box to accordion container
     */
    public function append(string $title, $content, $color = "primary"): Accordion
    {
        if ($content instanceof Renderable) {
            $this->rows[] = [
                'id' => Str::random(),
                'title' => $title,
                'content' => $content->render(),
                'color' => $color,
            ];
        } else {
            $this->rows[] = [
                'id' => Str::random(),
                'title' => $title,
                'content' => (string)$content,
                'color' => $color,
            ];
        }
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function render(): string
    {
        $variables = [
            'id' => $this->id,
            'rows' => $this->rows,
            'attributes' => $this->formatClasses()
        ];

        return view($this->view, $variables)->render();
    }
}