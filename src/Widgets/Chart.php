<?php

namespace Skybotgroup\ALTE2Widgets\Widgets;

use App\Bots;
use Encore\Admin\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Chart extends Widget
{
    /**
     * @var string
     */
    protected $id;
    /**
     * @var string
     */
    protected $type = "";
    /**
     * @var array
     */
    protected $data = [];
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var null
     */
    protected $ajax = null;

    /**
     * Chart constructor.
     */
    public function __construct()
    {
        $this->id = Str::random();
    }

    /**
     * @return string
     */
    protected function script(){
        $all = [
            "type" => $this->type,
            "data" => $this->data,
            "options" => $this->options,
        ];
        $script = "
            $('#$this->id').ready(function() {
                let all = ".json_encode($all).";
                
                // Additional tooltip map method
                all.options.tooltips = {
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
                charts['$this->id'] = new Chart(document.getElementById('$this->id').getContext('2d'), all);
            });
        ";
        if ($this->ajax !== null){
            $script.= $this->ajaxScript();
        }
        return $script;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $form = new Form();
        if ($this->ajax !== null)
        {
            $form->daterangepicker(["$this->id-start", "$this->id-end"], 'Период')
                ->ranges([
                    'Today' => [Carbon::today()->toDateString(), Carbon::today()->toDateString()],
                    'Yesterday' => [Carbon::yesterday()->toDateString(), Carbon::yesterday()->toDateString()],
                    'Last 7 Days' => [Carbon::today()->subDays(6)->toDateString(), Carbon::today()->toDateString()],
                    'Last 14 Days' => [Carbon::today()->subDays(13)->toDateString(), Carbon::today()->toDateString()],
                    'Last 30 Days' => [Carbon::today()->subDays(29)->toDateString(), Carbon::today()->toDateString()],
                    'This Month' => [Carbon::today()->startOfMonth()->toDateString(), Carbon::today()->endOfMonth()->toDateString()],
                    'Last Month' => [Carbon::today()->subMonth()->firstOfMonth()->toDateString(), Carbon::today()->subMonth()->lastOfMonth()->toDateString()],
                ])->defaultRange([
                    // last 30 days
                    Carbon::today()->subDays(29)->toDateString(),
                    Carbon::today()->toDateString()
                ]);
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
    public function setData($data){
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * @param $options
     * @return $this
     */
    public function setOptions($options){
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    /**
     * @param $method
     * @return $this
     */
    public function ajax($method){
        $this->ajax = $method;
        return $this;
    }

    /**
     * @return string
     */
    protected function ajaxScript(){
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