<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Group', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            [
                'attribute'=>'leader',
                'value'=>'leader.name',
            ],
            //'leader_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'buttons'=>[                   
                    'leader'=>function($url, $model){
                        $url= yii\helpers\Url::to(['addleader', 'id'=>$model->id]);
                        return Html::a('add leader', $url);
                    },
                    'unregleader'=>function($url, $model){
                        $url = Url::to(['unregleader', 'id'=>$model->id]);
                        return Html::a('unreg leader', $url);
                    }
                ]
            ],
                
           
        ],
    ]); ?>


</div>
