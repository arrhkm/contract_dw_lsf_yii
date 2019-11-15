<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="contract-view">

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
            'number_contract',
            'doc_date',
            'start_date',
            'end_date',
            'contract_distance',
            'besar_upah',
            'corporate_name',
            'corporate_address',
            'jenis_usaha',
            'jabatan_id',
            'cara_pembayaran',
            'tempat_aggrement',
            'pejabat_acc',
            'contract_type_id',
            'employee_id',
            'project_id',
            'status',
        ],
    ]) ?>

</div>
