<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RegisteremailgroupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="registeremailgroup-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'email_group_id') ?>

    <?= $form->field($model, 'group_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
