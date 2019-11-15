<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Emailgroup */

$this->title = 'Create Emailgroup';
$this->params['breadcrumbs'][] = ['label' => 'Emailgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="emailgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
