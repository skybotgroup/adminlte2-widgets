<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use Encore\Admin\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Support\Str;
use Carbon\Carbon;

/**
 * Class Chart
 * @package Skybotgroup\ALTE2Widgets\Widgets
 */
class Chart extends Widget
{
    protected $id;
    protected $type = "";
    protected $data = [];
    protected $options = [];
    protected $ajax = null;
    protected $range = false;
    protected $ranges = null;
    protected $defaultRange = null;

    /**
     * Chart constructor.
     */
    public function __construct()
    {
        $this->id = Str::random();
        parent::__construct();
    }

    /**
     * @return string
     */
    protected function script(): string
    {
        $all = [
            "type" => $this->type,
            "data" => $this->data,
            "options" => $this->options,
        ];
        $script = "
            $('#$this->id').ready(function() {
                let all = " . json_encode($all) . ";
                
                // Additional tooltip map method
                all.options.plugins = {
                    tooltip : {
                        callbacks: {
                            label: function(context) {     
                                let label = '';
                                if ('label' in context.dataset){
                                    label = context.dataset.label.split(':')[0];                                
                                }else{
                                    label = context.label.split(':')[0];
                                }
                                let value = context.formattedValue;
                                return label + ' : ' + value;
                            }
                        }
                    }
                };
                charts['$this->id'] = new Chart(document.getElementById('$this->id').getContext('2d'), all);
            });
        ";
        if ($this->ajax !== null) {
            $script .= $this->ajaxScript();
        }
        return $script;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $form = new Form();
        if ($this->ajax !== null) {
            if ($this->range) {
                $form->daterangepicker(["$this->id-start", "$this->id-end"], __('Period'))
                    ->ranges($this->ranges ?? [
                            __('Today') => [Carbon::today()->toDateString(), Carbon::today()->toDateString()],
                            __('Yesterday') => [Carbon::yesterday()->toDateString(), Carbon::yesterday()->toDateString()],
                            __('Last 7 Days') => [Carbon::today()->subDays(6)->toDateString(), Carbon::today()->toDateString()],
                            __('Last 14 Days') => [Carbon::today()->subDays(13)->toDateString(), Carbon::today()->toDateString()],
                            __('Last 30 Days') => [Carbon::today()->subDays(29)->toDateString(), Carbon::today()->toDateString()],
                            __('This Month') => [Carbon::today()->startOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()],
                            __('Last Month') => [Carbon::today()->subMonth()->firstOfMonth()->toDateString(), Carbon::today()->subMonth()->lastOfMonth()->toDateString()],
                        ])->defaultRange($this->defaultRange ?? [
                            // last 30 days
                            Carbon::today()->subDays(29)->toDateString(),
                            Carbon::today()->toDateString()
                        ]);
            } else {
                $form->daterangepicker("{$this->id}-date", __('Date'));
            }

        }
        Admin::script($this->script());

        $form->html("<canvas id='$this->id'></canvas>")->plain();

        $form->disableReset();
        $form->disableSubmit();

        return $form->render();
    }

    /**
     * @param $data
     * @return $this
     */
    public function setData($data): Chart
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * @param $options
     * @return $this
     */
    public function setOptions($options): Chart
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     * @param $method
     * @param bool $range
     * @param array $ranges
     * @param array $defaultRange
     * @return $this
     */
    public function ajax($method, $range = false, $ranges = null, $defaultRange = null): Chart
    {
        $this->ajax = $method;
        $this->range = $range;
        $this->ranges = $ranges;
        $this->defaultRange = $defaultRange;
        return $this;
    }

    protected function ajaxScript(): string
    {
        if ($this->range) {
            return $this->ajaxRangeScript();
        } else {
            return $this->ajaxDateScript();
        }
    }

    /**
     * @return string
     */
    protected function ajaxDateScript(): string
    {
        return <<<SCRIPT
            $('.$this->id-date').ready(function() {
                let date = $('.$this->id-date').val();
                
                $.ajax({
                    url: '$this->ajax',
                    data: {
                        '_token' : LA.token,
                        'date': date
                    },
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR){
                        charts['$this->id'].data = data;
                        charts['$this->id'].options.tooltips = {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    if ('label' in data.datasets[tooltipItem.datasetIndex]){
                                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value;
                                    }else{
                                         return data.labels[tooltipItem.index];
                                    }
                                }
                            }
                        };
                        charts['$this->id'].update();
                    },
                    fail: function(jqXHR, textStatus){
                        console.error(textStatus);
                    }
                });
    
                $('.$this->id-date').on('apply.daterangepicker', function(ev, picker) {
                    let date = $('.$this->id-date').val();
                    
                    $.ajax({
                        url: '$this->ajax',
                        data: {
                            '_token' : LA.token,
                            'date': date
                        },
                        dataType: 'json',
                        success: function(data, textStatus, jqXHR){
                            charts['$this->id'].data = data;
                            charts['$this->id'].options.tooltips = {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        if ('label' in data.datasets[tooltipItem.datasetIndex]){
                                            return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value;
                                        }else{
                                             return data.labels[tooltipItem.index];
                                        }
                                    }
                                }
                            };
                            charts['$this->id'].update();
                        },
                        fail: function(jqXHR, textStatus){
                            console.error(textStatus);
                        }
                    });
                });
            });   
SCRIPT;
    }

    private function ajaxRangeScript(): string
    {
        return <<<SCRIPT
            $('.$this->id-start_$this->id-end').ready(function() {
                let range = $('.$this->id-start_$this->id-end').val().split(' - ');
                
                $.ajax({
                    url: '$this->ajax',
                    data: {
                        '_token' : LA.token,
                        'start': range[0],
                        'end': range[1]
                    },
                    dataType: 'json',
                    success: function(data, textStatus, jqXHR){
                        charts['$this->id'].data = data;
                        charts['$this->id'].options.tooltips = {
                            callbacks: {
                                label: function(tooltipItem, data) {
                                    if ('label' in data.datasets[tooltipItem.datasetIndex]){
                                        return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value;
                                    }else{
                                         return data.labels[tooltipItem.index];
                                    }
                                }
                            }
                        };
                        charts['$this->id'].update();
                    },
                    fail: function(jqXHR, textStatus){
                        console.error(textStatus);
                    }
                });
    
                $('.$this->id-start_$this->id-end').on('apply.daterangepicker', function(ev, picker) {
                    let range = $('.$this->id-start_$this->id-end').val().split(' - ');
                    
                    $.ajax({
                        url: '$this->ajax',
                        data: {
                            '_token' : LA.token,
                            'start': range[0],
                            'end': range[1]
                        },
                        dataType: 'json',
                        success: function(data, textStatus, jqXHR){
                            charts['$this->id'].data = data;
                            charts['$this->id'].options.tooltips = {
                                callbacks: {
                                    label: function(tooltipItem, data) {
                                        if ('label' in data.datasets[tooltipItem.datasetIndex]){
                                            return data.datasets[tooltipItem.datasetIndex].label + ': ' + tooltipItem.value;
                                        }else{
                                             return data.labels[tooltipItem.index];
                                        }
                                    }
                                }
                            };
                            charts['$this->id'].update();
                        },
                        fail: function(jqXHR, textStatus){
                            console.error(textStatus);
                        }
                    });
                });
            });   
SCRIPT;
    }
}