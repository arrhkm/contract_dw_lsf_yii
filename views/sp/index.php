<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sps';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sp', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'jenis_sp',
            'tgl_sp',
            'duration_sp',
            [
                'label'=>'expired sp', 
                'value'=>function($model){
                    $date_sp_expired = date_create(date($model->tgl_sp));
                    $str_duration = "P".$model->duration_sp."M";
                    date_add($date_sp_expired, New DateInterval($str_duration));
                    return date_format($date_sp_expired,"Y-m-d");
                }
            ],
            //'id_employee_employee',
            //'employee_name',
            [
                'attribute'=>'person',
                'value'=>'employee.person.name',
            ],
              

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
