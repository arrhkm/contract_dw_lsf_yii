<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_hired')->textInput() ?>

    <?= $form->field($model, 'is_permanent')->checkbox() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'person_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_employee')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_contract')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
