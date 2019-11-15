<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


$this->title = 'List contract warming remainder : ';
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';

if(isset($provider)){    
    echo GridView::widget([
        'dataProvider'=>$provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'number_contract',
            'name',
            'start_date',
            'end_date',
            'employee_id',
            'jedah',
            //'dscription',
            //'docdate',
            //'is_active_remainder:boolean',
            //'contract_type',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{edit}',
                    'buttons'=>[
                        'edit'=>function($url, $model){
                            $url = Url::to(['contract/update', 'id'=>$model['id']]);
                            return Html::a('edit', $url);
                        }
                    ]
               
            ],
        ],
    ]);
}
//var_dump($employee);
//var_dump($contracts);