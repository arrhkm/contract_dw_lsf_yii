<?php

use app\components\ContractEmp;
use yii\helpers\Html;
use yii\grid\GridView;

use app\components\EmployeeCountContract;
use app\models\Employee;
use fedemotta\datatables\DataTables;

//use app\components\ContractEmp;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Employees';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employee', ['create'], ['class' => 'btn btn-success']) ?>
        <?php //= Html::a('Search Employee', ['search'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_number',
            [
                'attribute'=>'person',
                'value'=>'person.name',
            ],
            [
                'label'=>'n contract', 
                'value'=>function($model){
                    $jml = New EmployeeCountContract($model->id);
                    return $jml->countCountract();
                }
            ],
            //[
            //    'attribute'=>'group',
            //    'value'=>'groupemployee.group.name',
            //],
            
            'date_of_hired',
            //[
            //    'attribute'=>'bpjs_kes',
            //    'value'=>'person.no_bpjs_kesehatan',
            //],
            //[
            //    'attribute'=>'bpjs_tk',
            //    'value'=>'person.no_bpjs_tenaga_kerja',
            //],
            'is_permanent:boolean',
            //'email:email',
            //'person_id',
            'status', 
            'status_contract',
            'type',
            [
                'label'=>'Contract Terahir',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->number_contract;
                }
            ],
            [
                'label'=>'Tgl Contract',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->start_date;
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete} {unreg}',
                'buttons'=>[
                    'unreg'=>function($url, $model){
                        if (isset($model->person_id)){
                            $url= yii\helpers\Url::to(['unregemp', 'id'=>$model->id]);
                        }else {
                            $url='#';
                        }
                        //$url= yii\helpers\Url::to(['unregemp', 'id'=>$model->id]);
                        return Html::a('unregemp', $url);
                    }
                ]
                
            ],
            
        ],
    ]);?>
    <?/*= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'id'=>'myTable',
        'clientOptions' => [
            "lengthMenu"=> [[10,-1], [10,Yii::t('app',"All")]],
            //"info"=>false,
            "responsive"=>true, 
            "dom"=>'Bfrtip',
            //"dom"=> 'lfTrtip',
            "buttons" => ['copy', 'excel', 'pdf'],
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'reg_number',
            [
                'attribute'=>'person',
                'value'=>'person.name',
            ],
            [
                'label'=>'n contract', 
                'value'=>function($model){
                    $jml = New EmployeeCountContract($model->id);
                    return $jml->countCountract();
                }
            ],
            //'date_of_hired',
            'is_permanent',
            'status', 
            'status_contract',
            'type',
            [
                'label'=>'Contract Terahir',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->number_contract;
                }
            ],
            [
                'label'=>'Progress Ke',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->contract_progress_num;
                }
            ],
            [
                'label'=>'Progress',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->contract_progress_status;
                }
            ],
            [
                'label'=>'Tgl Contract',
                'value'=>function($model){
                    $contract = New ContractEmp();
                    $contract_ini = $contract->getContractActive($model->id);
                    return $contract_ini->start_date;
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
            
        ],
        
    ]);*/?>


</div>

<?php 
/*
$script = <<<JS
    $('#myTable').DataTable( {
    buttons: [
        'copy', 'excel', 'pdf'
    ]
} );
JS;

$this->registerJs($script);
*/