<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsEmailgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Emailgroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Emailgroup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
