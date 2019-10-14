<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Registeremailgroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registeremailgroup-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email_group_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
