<?php
use yii;
use yii\helpers\Html;
use yii\grid\GridView;

use yii\data\ActiveDataProvider;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
