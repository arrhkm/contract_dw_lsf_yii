<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\jui\DatePicker;
use app\commands\ListPerson;

/* @var $this yii\web\View */
/* @var $model app\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'reg_number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'person_id')->label('Person')->widget(Select2::class,[
        'data'=> ListPerson::getListPersonRelatet(),
        'options'=>[
            'prompt'=>'blank..',
            'placeholder'=>'Select ..',
        ]
    ]) ?>

    <?= $form->field($model, 'number_bpjstk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number_bpjskes')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_hired')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
       
        
    ]) ?>

    <?= $form->field($model, 'is_permanent')->checkbox() ?>

    <?php //= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
 