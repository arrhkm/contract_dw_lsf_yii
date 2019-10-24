<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupemployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groupemployees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupemployee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Groupemployee', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'employee_id',            
            //'group_id',
            [
                'attribute'=>'reg_number',
                'value'=>'employee.reg_number',
            ],
            [
                'attribute'=>'person',
                'value'=>'employee.person.name',
            ],
            [
                'attribute'=>'group',
                'value'=>'group.name',
            ],
            [
                'attribute'=>'src_leader',
                'value'=>'group.leader.name',
            ],
            'group.name',
            'group.leader.name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
