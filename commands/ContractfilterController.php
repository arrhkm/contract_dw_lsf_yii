<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use DateInterval;
use app\models\Contract;
use app\models\Emailgroup;
use app\models\Group;
use app\models\Registeremailgroup;

class ContractfilterController extends Controller
{
    
    public function actionKirimemail(){
        $interval_day = 30; //30 days
        $today = date_create(date('Y-m-d'));
        $today_str = date_format($today,"Y-m-d");
        $interval = new DateInterval("P".$interval_day."D");        
        $end_date = $today->add($interval);
        $end_date_str = date_format($end_date,'Y-m-d');
        //------------------------------------------
                       
        $model = Contract::find()->with('employee')
        ->where(['contract_contract.status' => 'notified'])
        ->orWhere(
           ['between',
               'contract_contract.end_date',
               $today_str,
               $end_date_str,
           ]
        )->all();
        $id_to_active = [];
        $group_sent = [];


        foreach ($model as $dt_contract){
            if ($dt_contract->status == 'active'){
                array_push($id_to_active, $dt_contract['id']);
            }           
            if (isset($dt_contract->employee->groupemployee->group->id)){
                array_push($group_sent, $dt_contract->employee->groupemployee->group->id);
            }
        }

        //Update COntract active to notified
        Contract::updateAll(['status'=>'notified'], ['IN', 'id', $id_to_active]);
        //end 

       
        $model_sent = Contract::find()
        ->join('JOIN','employee_employee', 'employee_employee.id=contract_contract.employee_id') 
        ->join('JOIN', 'employee_groupemployee', 'employee_employee.id = employee_groupemployee.employee_id')
        ->join('JOIN', 'employee_group', 'employee_group.id = employee_groupemployee.group_id')
        ->where(['contract_contract.status' => 'notified'])

        ->andWhere([
            'between',
            'contract_contract.end_date',
            $today_str,
            $end_date_str,
        ])       
        ->all();
        
       
        $content = [];
        foreach ($this->getGroupId() as $group){            
            $group_id = $group->id;
            $group_name = $group->name;
            $group_email = $this->getEmailGroup($group->id);
            $group_contract = $this->getContract($group->id);
            
            array_push($content, [                
                'group_id'=>$group_id,
                'group_name'=>$group_name,
                'group_email'=>$group_email,
                'group_contract'=>$group_contract,         
            ]); 
        }
       
        //SEND TO Email 

        foreach ($content as $contents){
            $messages = [];
            foreach ($contents['group_email'] as $email) {
                //subject
                $subject = "Remainder Contract".$contents['group_name'];
                //message
                $messages[] = Yii::$app->mailer                           
                    ->compose('remainder',[
                        'group_name'=>$contents['group_name'], 
                        'contract'=> $contents['group_contract'],
                    ])
                    ->setTo($email)
                    ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' admin'])
                    ->setSubject($subject);
            }
           
            Yii::$app->mail->sendMultiple($messages);
            
        }      
    }

    public function getGroupId()
    {
        $interval_day = 30; //30 days
        $today = date_create(date('Y-m-d'));
        $today_str = date_format($today,"Y-m-d");
        $interval = new DateInterval("P".$interval_day."D");        
        $end_date = $today->add($interval);
        $end_date_str = date_format($end_date,'Y-m-d');
        //----------------------------------

        $model_sent = Contract::find()
        ->join('JOIN','employee_employee', 'employee_employee.id=contract_contract.employee_id') 
        ->join('JOIN', 'employee_groupemployee', 'employee_employee.id = employee_groupemployee.employee_id')
        ->join('JOIN', 'employee_group', 'employee_group.id = employee_groupemployee.group_id')       
        ->where(['contract_contract.status' => 'notified'])

        ->andWhere([
            'between',
            'contract_contract.end_date',
            $today_str,
            $end_date_str,
        ])       
        ->all();

        $group_id=[];
        foreach ($model_sent as $dt){
            array_push($group_id,$dt->employee->groupemployee->group->id);          
            
        }
        $group_id = array_unique($group_id);
        $model_group = Group::find()->where(['IN', 'id', $group_id])->all();
        return $model_group;
    }


    public function getEmailGroup($group_id){
        $reg_email = Registeremailgroup::find()->joinWith('emailgroup')->where(['group_id'=>$group_id])->all();
        $list_email = [];
        foreach ($reg_email as $list){
            $email = $list->emailgroup->email;
            array_push($list_email, $email);
        }

        return $list_email;
    }

    public function getContract($group_id){
        $interval_day = 30; //30 days
        $today = date_create(date('Y-m-d'));
        $today_str = date_format($today,"Y-m-d");
        $interval = new DateInterval("P".$interval_day."D");        
        $end_date = $today->add($interval);
        $end_date_str = date_format($end_date,'Y-m-d');
        //----------------------------------

        $model_sent = Contract::find()
        ->join('JOIN','employee_employee', 'employee_employee.id=contract_contract.employee_id') 
        ->join('JOIN', 'employee_groupemployee', 'employee_employee.id = employee_groupemployee.employee_id')
        ->join('JOIN', 'employee_group', 'employee_group.id = employee_groupemployee.group_id')       
        ->where(['contract_contract.status' => 'notified'])

        ->andWhere([
            'between',
            'contract_contract.end_date',
            $today_str,
            $end_date_str,
        ])
        ->andFilterWhere(['employee_group.id'=>$group_id])       
        ->all();
        $contract = [];
        foreach ($model_sent as $dt_contract){
            array_push($contract, [
                'name'=>$dt_contract->employee->person->name,
                'reg_number'=>$dt_contract->employee->reg_number,
                'number_contract'=>$dt_contract->number_contract,
                'start_date'=>$dt_contract->start_date,
                'end_date'=>$dt_contract->end_date,
            ]);
        }
        return $contract;
    }

    public function getModelContract($group_id = Null){
        $model_sent = Contract::find()
        ->join('JOIN','employee_employee', 'employee_employee.id=contract_contract.employee_id') 
        ->join('JOIN', 'employee_groupemployee', 'employee_employee.id = employee_groupemployee.employee_id')
        ->join('JOIN', 'employee_group', 'employee_group.id = employee_groupemployee.group_id')       
        ->where(['contract_contract.status' => 'notified'])

        ->andWhere([
            'between',
            'contract_contract.end_date',
            $today_str,
            $end_date_str,
        ]);
        if (isset($group_id)){
            $model_sent->andFilterWhere(['employee_group.id'=>$group_id]);
        }
              
        $model_sent->all();
        $contract = [];
        foreach ($model_sent as $dt_contract){
            array_push($contract, [
                'name'=>$dt_contract->employee->person->name,
                'reg_number'=>$dt_contract->employee->reg_number,
                'number_contract'=>$dt_contract->number_contract,
                'start_date'=>$dt_contract->start_date,
                'end_date'=>$dt_contract->end_date,
            ]);
        }
        return $contract;
    }

    public function actionKirimhod(){
        $model_group = Group::find()->where(['name'=>'HRD'])->scalar();
        return $model_group;
    }

    
}