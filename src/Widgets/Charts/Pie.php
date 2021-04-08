<?php


namespace Skybotgroup\ALTE2Widgets\Widgets\Charts;

use Encore\Admin\Admin;
use Encore\Admin\Widgets\Form;
use Skybotgroup\ALTE2Widgets\Widgets\Chart;

class Pie extends Chart
{
    protected $type = "pie";

    public function render(): string
    {
        $form = new Form();
        if ($this->ajax !== null)
        {
            $form->daterangepicker("{$this->id}-date", 'Дата');
        }
        Admin::script($this->script());

        $form->html("<canvas id='$this->id'></canvas>")->plain();

        $form->disableReset();
        $form->disableSubmit();

        return $form->render();
    }
    protected function ajaxScript()
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