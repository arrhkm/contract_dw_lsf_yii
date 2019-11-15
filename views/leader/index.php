<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leaders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leader-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Leader', ['create'], ['class' => 'btn btn-success']) ?>
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
            'jabatan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
