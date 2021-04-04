<?php


namespace Skybotgroup\ALTE2Widgets\Widgets;


class Progress extends Widget
{
    protected $view = "adminlte2-widgets::progress.progress";
    /**
     * @var float
     */
    protected $percent;
    /**
     * @var string
     */
    protected $description;
    /**
     * @var string
     */
    protected $color;


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
    }

    /**
     * @return $this
     */
    public function active(): Progress
    {
        $this->class("active");
        return $this;
    }

    /**
     * @return $this
     */
    public function vertical(): Progress
    {
        $this->class("vertical");
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
            'attributes' => $this->formatAttributes()
        ];

        return view($this->view, $variables)->render();
    }
}