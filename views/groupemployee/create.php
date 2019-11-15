<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Groupemployee */

$this->title = 'Create Groupemployee';
$this->params['breadcrumbs'][] = ['label' => 'Groupemployees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupemployee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
