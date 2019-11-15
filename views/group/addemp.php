<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Groupemployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="groupemployee-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->widget(Select2::class,[
        'data'=> ArrayHelper::map(\app\models\Employee::find()->all(), 'id','person.name'),
    ]) ?>

    <?php //= $form->field($model, 'group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
