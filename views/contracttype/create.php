<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Contracttype */

$this->title = 'Create Contracttype';
$this->params['breadcrumbs'][] = ['label' => 'Contracttypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracttype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
