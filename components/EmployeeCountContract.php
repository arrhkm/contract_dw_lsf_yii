<?php 
namespace app\components;

use app\models\Contract;



class EmployeeCountContract{

    public $_employee_id;
    function __construct($employee_id) {
        $this->employee_id = $employee_id;
      }

 
    public function countCountract(){
        $query = Contract::find()->with('employee');
        $query->where(['employee_id'=>$this->employee_id])->all();
        return $query->count();
        
    }

}
