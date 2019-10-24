<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'People';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idcard',
            'name',
            'birth_of_date',
            'birth_city',
            //'phone',
            //'address',
            //'bank_account',
            //'marital:boolean',
            //'gender',
            //'tax_account',
            //'city',
            'district', 
            'no_bpjs_kesehatan',
            'no_bpjs_tenaga_kerja',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
