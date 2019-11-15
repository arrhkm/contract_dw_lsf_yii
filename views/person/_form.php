<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Person */
/* @var $form yii\widgets\ActiveForm */


    $person_gender = ['M'=>'Male', 'F'=>'Female'];
     
?>

<div class="person-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idcard')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'birth_of_date')->widget(DatePicker::class, [
        'dateFormat' => 'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'birth_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'marital')->widget(kartik\select2\Select2::class,[
        'data' => ['M'=>'Marit', 'S'=>'Single'],
        'options' => ['placeholder' => 'Select Marital ...'],
        /*'pluginOptions' => [
            'allowClear' => true
        ],*/
    ]) ?>

    <?= $form->field($model, 'gender')->widget(kartik\select2\Select2::class,[
        'data' => ['M'=>'Male', 'F'=>'Female'],
        'options' => ['placeholder' => 'Select a state ...'],
        /*'pluginOptions' => [
            'allowClear' => true
        ],*/
    ]) ?>

    <?= $form->field($model, 'tax_account')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_bpjs_kesehatan')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
