<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Search Employee', ['search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'reg_number',
            [
                'attribute'=>'person',
                'value'=>'person.name',
            ],
            [
                'attribute'=>'group',
                'value'=>'groupemployee.group.name',
            ],
            
            'date_of_hired',
            [
                'attribute'=>'bpjs_kes',
                'value'=>'person.no_bpjs_kesehatan',
            ],
            [
                'attribute'=>'bpjs_tk',
                'value'=>'person.no_bpjs_tenaga_kerja',
            ],
            //'is_permanent:boolean',
            //'email:email',
            //'person_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {unreg}',
                'buttons'=>[
                    'unreg'=>function($url, $model){
                        if (isset($model->person_id)){
                            $url= yii\helpers\Url::to(['unregemp', 'id'=>$model->id]);
                        }else {
                            $url='#';
                        }
                        //$url= yii\helpers\Url::to(['unregemp', 'id'=>$model->id]);
                        return Html::a('unregemp', $url);
                    }
                ]
                
            ],
        ],
    ]); ?>


</div>
