<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registeremailgroup */

$this->title = 'Update Registeremailgroup: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Registeremailgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="registeremailgroup-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
