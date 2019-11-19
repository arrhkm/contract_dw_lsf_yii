<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\jui\DatePicker;
use yii\helpers\ArrayHelper;

use app\commands\ListPerson;

/* @var $this yii\web\View */
/* @var $model app\models\Contract */
/* @var $form yii\widgets\ActiveForm */


 
?>

<div class="contract-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'number_contract')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->label('Employee')->widget(Select2::class,[
        'data'=> ListPerson::getListPerson(),
    ]) ?>

    <?= $form->field($model, 'doc_date')->widget(DatePicker::class, [
        'dateFormat'=>'php:Y-m-d',
        'inline'=>True,
        
    ]) ?>

    <?= $form->field($model, 'start_date')->widget(DatePicker::class,[
        'dateFormat'=>'php:Y-m-d', 
    ]) ?>

    <?= $form->field($model, 'end_date')->widget(DatePicker::class, [
        'dateFormat'=>'php:Y-m-d',
    ]) ?>

    <?= $form->field($model, 'contract_distance')->textInput() ?>

    <?= $form->field($model, 'contract_progress_status')->widget(Select2::className(), [
        'data'=>['contract'=>'contract', 'extends'=>'extends'],
        'options' => ['placeholder' => 'Select Status Progress ...'],
        'pluginOptions' => ['allowClear' => true],
    ]) ?>

    <?= $form->field($model, 'contract_progress_num')->textInput() ?>

    <?= $form->field($model, 'jabatan_id')->widget(Select2::class, [
        'data'=> \app\commands\JabatanList::getListJabatan(),
        'options'=>[
            'placeholder'=>'Select ..',
            'multiple'=>FALSE,
            
        ]
    ]) ?>

    <?= $form->field($model, 'contract_type_id')->widget(Select2::class, [
        'data'=> app\commands\ListContractType::getListContractType(),
    ]) ?>

    

    <?= $form->field($model, 'project_id')->label('Project')->widget(Select2::class, [
        'data'=> \app\commands\ListProject::getListProject(),
        'options' => ['placeholder' => 'Select  ...'],
    ]) ?>

    

    <?= $form->field($model, 'status')->widget(Select2::class,[
            //'maxlength' => true, 
            'readonly'=>TRUE,
            'data'=> \app\commands\ProjectStatus::getListProjectStatus(),
        ]) ?>

    

    <?= $form->field($model, 'besar_upah')->textInput() ?>

    <?= $form->field($model, 'corporate_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corporate_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jenis_usaha')->textInput(['maxlength' => true]) ?>

   
    <?= $form->field($model, 'cara_pembayaran')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_aggrement')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pejabat_acc')->textInput(['maxlength' => true]) ?>

   

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
