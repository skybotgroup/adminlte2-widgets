<?php


namespace Skybotgroup\ALTE2Widgets\Widgets;


use Encore\Admin\Admin;
use Encore\Admin\Widgets\Form;
use Illuminate\Support\Str;

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
     * Chart constructor.
     */
    public function __construct()
    {
        $this->id = Str::random();
    }


    protected function script(){
        Admin::script("
            $( '#$this->id' ).ready(function() {
                let data = ".json_encode($this->data).";
                data.options = {
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                if ('label' in data.datasets[tooltipItem.datasetIndex]){
                                    return data.datasets[tooltipItem.datasetIndex].label + ': '+ tooltipItem.value;
                                }else{
                                    console.log(data);
                                     return data.labels[tooltipItem.index];
                                }
                            }
                        }
                    }
                };
                let ctx = document.getElementById('$id').getContext('2d');
                let myChart = new Chart(ctx, data);
            });
        ");

        return "<canvas id='$id'></canvas>";
    }

    public function render(): string
    {
        $form = new Form();

        $form->dateRange("start", "end", "Fine");
        $form->disableReset();
        $form->disableSubmit();
        $form->html("<canvas id='$this->id'></canvas>");
//        Admin::script("")
        return $form->render();
    }
}