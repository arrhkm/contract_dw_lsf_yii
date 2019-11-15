<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use app\models\Employee;
use app\models\Contract;


/**
 * Description of CekContract
 *
 * @author it
 */
class CekContract {
    //put your code here
    
    public static function getData($days_interval=30){
        /*
        $today = date_create(date('Y-m-d'));
        $interval = new \DateInterval("P".$days_interval."D");
        $end_date = date_add($today, $interval);
        $condition = yii\db\conditions\BetweenCondition('contract_contract.end_date', 'between', $today->format('Y-m-d'),$end_date->format('Y-m-d'));
        $model = Contract::find()->joinWith('employee')
                ->where(['contract_contract.status' => 'notified'])
                ->orWhere([$condition])
                ->all();
        return $model; 
         * 
         */
        $today = date_create(date('Y-m-d'));
        $interval = new \DateInterval("P".$days_interval."D");
        $end_date = date_add($today, $interval);
        $mo = Contract::find()->joinWith('employee')
         ->where(['contract_contract.status' => 'notified'])
         ->orWhere(
           ['between',
               'contract_contract.end_date',
               $today->format('Y-m-d'),
               $end_date->format('Y-m-d')
           ]
         )
         ->all();
        return $mo;
    }
}

/*
 
 *
 */