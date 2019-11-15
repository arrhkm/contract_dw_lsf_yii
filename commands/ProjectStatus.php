<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use yii\helpers\ArrayHelper;

/**
 * Description of ProjectStatus
 *
 * @author it
 */
class ProjectStatus {
    //put your code here
    public static function getListProjectStatus(){
        $status = [
            'active'=>'active', 
            'close'=>'close', 
            'notified'=>'notified'
        ];
        return $status;
    }
    
}
