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
            
            //'date_of_hired',
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

   


</div>

<?php 
