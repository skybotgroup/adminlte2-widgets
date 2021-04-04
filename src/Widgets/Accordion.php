<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Encore\Admin\Widgets\Widget;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Str;

class Accordion extends Widget implements Renderable
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
     * @param $content
     * @param string $color
     * @return $this
     */
    public function append(string $title, $content, $color = "primary"): Accordion
    {
        if ($content instanceof Renderable) {
            $rows[] = [
                'id' => Str::random(),
                'title' => $title,
                'content' => $content->render(),
                'color' => $color,
            ];
        } else {
            $rows[] = [
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
        $variables = array_merge(['id' => $this->id],['rows' => $this->rows], ['attributes' => $this->formatAttributes()]);

        return view($this->view, $variables)->render();
    }
}