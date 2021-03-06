<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Employees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">

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
            'reg_number',           
            //'date_of_hired',
            'is_permanent:boolean',
            'email:email',
            'person_id',
        ],
    ]) ?>

    <?=GridView::widget([
        'dataProvider' => $HkmDataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            'id',
            'start_date',
            'end_date',
            'contract_distance', 
            'contract_type_id', 
            'contractType.contract_name',
            'status', 
            'contract_progress_num'
        ],
    ])?>


</div>
