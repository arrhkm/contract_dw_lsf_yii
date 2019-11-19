<?php

use app\components\EmployeeCountContract;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\daterange\DateRangePicker;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;




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



    <?php /*= DateRangePicker::widget([
        //'name'=>'kvdate3',
        'model'=>$searchModel,
        'attribute' => 'createTimeRange',
        //'useWithAddon'=>true,
        'convertFormat'=>true,
        //'startAttribute' => 'createTimeStart',
        //'endAttribute' => 'createTimeEnd',
        'pluginOptions'=>[
            'locale'=>['format' => 'Y-m-d'],
        ]
    ]);*/?>


    
    <?php $form = ActiveForm::begin(
        [
            'action' => ['contract/index'],
            'options' => ['method' => 'post']
        ]
    );?>
    <?= $form->field($model_form,'date_time_start')->widget(DatePicker::class,[
        'dateFormat'=>'php:Y-m-d',
    ])?>
    <?= $form->field($model_form, 'date_time_end')->widget(DatePicker::class,[
        'dateFormat'=>'php:Y-m-d',
    ])?>
    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'id'=>'btn_search2']) ?>   
    <?php ActiveForm::end();?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'number_contract',
            [
                'attribute'=>'employee', 
                'value'=>'employee.reg_number',
            ],
            [
                'attribute'=>'person', 
                'value'=>'employee.person.name',
            ],
            [
                'attribute'=>'group',
                'value'=>'employee.groupemployee.group.name',
            ],
            [
                'attribute'=>'leader',
                'label'=>'Foreman',
                'value'=>'employee.groupemployee.group.leader.name',
            ],
            //'doc_date',
            'start_date',            
            'end_date',
            'contract_distance',
            /*[
                'label'=>'n contract', 
                'value'=> function($model){
                    $jml = New EmployeeCountContract($model->employee_id);
                    return $jml->countCountract();
                }
            ],*/
            'contract_progress_status', 
            'contract_progress_num',
            //'besar_upah',
            //'project.name',
            
            [
                'attribute'=>'contract_type',
                'value'=> 'contractType.contract_name',
            ],
            //'corporate_name',
            //'corporate_address',
            //'jenis_usaha',
            //'jabatan_id',
            //'cara_pembayaran',
            //'tempat_aggrement',
            //'pejabat_acc',
            //'contract_type_id',
            //'employee_id',
            //'project_id',
            'status',
          

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);?>


</div>

<?
$this->registerJs(<<<JS

    var x = document.getElementById("daterangeform-date_time_start").value;   
    if(x) {
        document.getElementById('btn_search2').enabled = TRUE;
        //alert("Ada isi nya");
    } else 
     //alert(" tidak ada isi nya");
    document.getElementById('btn_search2').disabled = TRUE;
    
  
JS
);