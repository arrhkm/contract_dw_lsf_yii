<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model app\models\Sp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sp-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'jenis_sp')->widget(Select2::class,[
        'data'=> app\components\ListStatusSp::getList(),
    ]) ?>

    <?= $form->field($model, 'tgl_sp')->widget(DatePicker::class,[
        'dateFormat'=>'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'duration_sp')->label('Duration SP(month)')->textInput() ?>

    <?= $form->field($model, 'id_employee_employee')->widget(Select2::class,[
        'data'=> app\commands\ListPerson::getListPerson(),
    ]) ?>

    <?php //= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'reg_number')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
