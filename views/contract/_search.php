<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ContractSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contract-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number_contract') ?>

    <?= $form->field($model, 'doc_date') ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'contract_distance') ?>

    <?php // echo $form->field($model, 'besar_upah') ?>

    <?php // echo $form->field($model, 'corporate_name') ?>

    <?php // echo $form->field($model, 'corporate_address') ?>

    <?php // echo $form->field($model, 'jenis_usaha') ?>

    <?php // echo $form->field($model, 'jabatan_id') ?>

    <?php // echo $form->field($model, 'cara_pembayaran') ?>

    <?php // echo $form->field($model, 'tempat_aggrement') ?>

    <?php // echo $form->field($model, 'pejabat_acc') ?>

    <?php // echo $form->field($model, 'contract_type_id') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'project_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
