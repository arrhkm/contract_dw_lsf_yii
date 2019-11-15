<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'reg_number') ?>

    <?= $form->field($model, 'date_of_hired') ?>

    <?= $form->field($model, 'is_permanent')->checkbox() ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'person_id') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'name_employee') ?>

    <?php // echo $form->field($model, 'idcard') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'status_contract') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
