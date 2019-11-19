<?php
namespace app\components;

use app\models\Contract;
use yii\base\Component;

class ContractProgress extends Component
{
    public $model;
    public $dt_array=[];
    function __construct($employee_id)
    {
        $this->model = Contract::find()->where(['employee_id'=>$employee_id])->orderBy('start_date ASC')->all();
        
    }

    function urutkan(){
        $i = 1;
        foreach ($this->model as $dt){
            $modelUpdate = Contract::findOne($dt->id);
            if ($this->isGenap($i)){               
                $modelUpdate->contract_progress_num = 2;
                $modelUpdate->save();
            } else {
                $modelUpdate->contract_progress_num = 1;
                $modelUpdate->save();
            }
            $i++;
        }
    }

    function isGenap($i){
        if ($i%2==0){
            return TRUE;
        }else {
            return FALSE;
        }
    }

    

}