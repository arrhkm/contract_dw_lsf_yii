<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'leader_id',
        ],
    ]) ?>
    <br>
    <hr>
    <h1 class="center-block"> Detil Email</h1>
    <hr>
    <p>
        <?= Html::a('Reg Email to Group', ['registeremailgroup', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider'=>$dataProvider2, 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            //'group_id',
            //'employee_id',
            'group.name',
            'emailgroup.name',
            'emailgroup.email',
            //'employee.person.name',
            [ 
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                'buttons'=>[
                    'delete'=>function($url, $model){
                        $url= yii\helpers\Url::to(['deleteregisteremailgroup', 'id'=>$model->id]);
                        return Html::a('Delete reg eamil', $url);
                    },
                ]
            ],
        ]    
            
        
    ]);?>
    
    <br>
    <hr>
    <h1 class="center-block"> Detil Group</h1>
    <hr>
    <p>
        <?= Html::a('Add Employee to Group', ['addemp', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider'=>$dataProvider, 
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'group_id',
            'employee_id',
            'group.name', 
            'employee.person.name',
            [ 
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{delete}',
                'buttons'=>[
                    'delete'=>function($url, $model){
                        $url= yii\helpers\Url::to(['deleteemp', 'id'=>$model->id]);
                        return Html::a('Delete Emp', $url);
                    },
                ]
            ],
        ]    
            
        
    ]);?>

</div>
