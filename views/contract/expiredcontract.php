<?php
use yii;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\data\ActiveDataProvider;
use app\components\EmployeeCountContract;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
    <?php //= Html::a('Create Contract', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Sent To Email Contract', ['sentmailcontract'], ['class' => 'btn btn-success']) ?>
</p>

<?php 
//echo "Today :".$today." /n";
print_r("Today_str :".$today_str."<br>");
//echo "end_date :".$end_date." /n";
print_r("end_date_str:".$end_date_str."<br>");

$provider = New ActiveDataProvider([
    'query'=>$model,
]);

?>
<style>
div.scroll-content {  
  overflow: auto;  
}
</style>
<div class="scroll-content">
<?=GridView::widget([
    'dataProvider'=>$provider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'number_contract',
        'employee.person.name',
        'employee.groupemployee.group.name',
        'doc_date',
        'start_date',
        'end_date',
        'contract_distance',
        'besar_upah',
        'status',
        [
            'label'=>'jumlah kontrak',
            'value'=>function($model){
                $x = new EmployeeCountContract($model->employee_id);
                return $x->countCountract();
            }
        ],
        [
            'label'=>'Jatuh Tempo(Hari)',
            'value'=> function($model){
                $jedah = \app\commands\DateRange::getRangeValueFromNow($model->end_date);
                return $jedah;
            },
            
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'template'=>'{view} {update}',
        ],
    ],
   
]);?>
</div>
