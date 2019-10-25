<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeBlacklistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employee Blacklists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-blacklist-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee Blacklist', ['create'], ['class' => 'btn btn-success']) ?>
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
            'address',
            'blacklist_date',
            //'dscription',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
