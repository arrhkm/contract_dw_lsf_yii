<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmployeeBlacklist */

$this->title = 'Create Employee Blacklist';
$this->params['breadcrumbs'][] = ['label' => 'Employee Blacklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-blacklist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
