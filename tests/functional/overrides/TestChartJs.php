<?php
namespace tests\overrides;

use dosamigos\chartjs\ChartJs;
use dosamigos\chartjs\ChartJsAsset;
use yii\helpers\Json;
use yii\web\View;

class TestChartJs extends ChartJs
{
    public function registerClientScript()
    {
        $id = $this->options['id'];
        $type = $this->type;
        $view = $this->getView();
        $data = !empty($this->data) ? Json::encode($this->data) : '{}';
        $options = !empty($this->clientOptions) ? Json::encode($this->clientOptions) : '{}';

        ChartJsAsset::register($view);

        $js = ";var chartJS_{$id} = new Chart(document.getElementById('{$id}').getContext('2d')).{$type}({$data}, {$options});";
        $view->registerJs($js, View::POS_READY, 'test-chartjs-js');
    }
}