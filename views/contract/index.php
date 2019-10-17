<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contract-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contract', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Expired Contract', ['expiredcontract'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'employee', 
                'value'=>'employee.person.name',
            ],
            'number_contract',
            'doc_date',
            'start_date',
            'end_date',
            'contract_distance',
            'besar_upah',
            //'corporate_name',
            //'corporate_address',
            //'jenis_usaha',
            //'jabatan_id',
            //'cara_pembayaran',
            //'tempat_aggrement',
            //'pejabat_acc',
            'contract_type_id',
            'employee_id',
            'project_id',
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
