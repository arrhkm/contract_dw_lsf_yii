<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RegisteremailgroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registeremailgroups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registeremailgroup-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Registeremailgroup', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'email_group_id:email',
            'group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
