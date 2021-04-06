<?php

namespace Skybotgroup\ALTE2Widgets\Widgets\Charts;

use Skybotgroup\ALTE2Widgets\Widgets\Chart;

class Line extends Chart
{
    protected $type = "line";
    protected $data = [];
    protected $options = [];

    /**
     *
    "datasets" =>
     * [
     *  [
     *      // More properties - https://www.chartjs.org/docs/latest/charts/line.html#dataset-properties
     *      "label" => "Label",
     *      "data" => [],
     *      "fill" => false,
     *      "borderColor" => "#337ab7",
     *  ],
     * ],
     * "labels" => [
     *     // Scale labels
     * ]
     */
}