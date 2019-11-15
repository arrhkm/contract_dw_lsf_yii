<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contracttype */

$this->title = 'Update Contracttype: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contracttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contracttype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
