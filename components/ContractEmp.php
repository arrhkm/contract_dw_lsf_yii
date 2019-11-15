<?php 
namespace app\components;


use yii\base\Component;
use app\models\Contract;
//use app\models\Employee;


class ContractEmp extends Component{

    public function getContractActive($id_employee){
        $contract = Contract::find()->where(['employee_id'=>$id_employee])
       ->orderBy('start_date desc')
       ->limit(1)
       ->One();
       return $contract;
    }

}