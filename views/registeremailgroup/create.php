<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Registeremailgroup */

$this->title = 'Create Registeremailgroup';
$this->params['breadcrumbs'][] = ['label' => 'Registeremailgroups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registeremailgroup-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
