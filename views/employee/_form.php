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

   

    <?= $form->field($model, 'date_of_hired')->widget(DatePicker::className(),[
        'dateFormat'=>'php:Y-m-d',
       
        
    ]) ?>

    <?= $form->field($model, 'status_contract')->widget(Select2::class,[
        'data'=> ['PKWT'=>'PKWT', 'PKWTT'=>'PKWTT'],
        'options'=>[
            'prompt'=>'blank..',
            'placeholder'=>'Select ..',
        ]
    ])?>

    <?php //= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'is_permanent')->checkBox(['label' => 'Permanent', 'selected' => $model->is_permanent])?>

    <?= $form->field($model, 'status')->widget(Select2::className(),[
        'data'=>['hired'=>'hired', 'out'=>'out']
    ])?>

    <?= $form->field($model, 'dscription_out')->textInput(['maxlength' => true]) ?>
    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
 