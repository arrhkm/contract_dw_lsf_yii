<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use yii\helpers\ArrayHelper;


/**
 * Description of ListContractType
 *
 * @author it
 */
class ListContractType {
    //put your code here
    public static function getListContractType(){
        $model = \app\models\Contracttype::find()->all();
        return ArrayHelper::map($model,'id', 'contract_name');
    }
}
