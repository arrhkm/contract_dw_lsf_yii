<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'jenis_sp') ?>

    <?= $form->field($model, 'tgl_sp') ?>

    <?= $form->field($model, 'duration_sp') ?>

    <?= $form->field($model, 'id_employee_employee') ?>

    <?php // echo $form->field($model, 'employee_name') ?>

    <?php // echo $form->field($model, 'reg_number') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
