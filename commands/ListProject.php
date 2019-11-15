<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

/**
 * Description of ListProject
 *
 * @author it


 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\ArrayHelper;

class ListProject
{
    public static function getListProject(){
        $model= \app\models\Project::find()->all();               
        /*$list = ArrayHelper::toArray($model, [
            'app\models\Employee'=>[
                'id',
                'reg_number',
                'reg_plus'=>function($emp){
                    return $emp->reg_number." - ".$emp->person->name;
                },
            ]
        ]); */
        $list_model= ArrayHelper::map($model, 'id', 'name');
        return $list_model;
    }
}