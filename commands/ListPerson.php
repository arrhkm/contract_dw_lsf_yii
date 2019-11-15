<?php
namespace app\commands;
use app\models\Employee;
use app\models\Person;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\ArrayHelper;

class ListPerson
{
    public static function getListPerson(){
        $emp= Employee::find()->with('person')->all();               
        $list = ArrayHelper::toArray($emp, [
            'app\models\Employee'=>[
                'id',
                'reg_number',
                'reg_plus'=>function($emp){
                    return $emp->reg_number." - ".$emp->person->name;
                },
            ]
        ]); 
        $list_emp = ArrayHelper::map($list, 'id', 'reg_plus');
        return $list_emp;
    }
    
    public static function getListPersonRelatet(){
        $persons_related = Person::find()->all();
        
        $list = ArrayHelper::toArray($persons_related, [
            'app\models\Person'=>[
                'id',
                'name',
                'idcard',
                'name_card'=>function($model){
                    return $model->idcard." - ".$model->name;
                },
            ]
        ]); 
        //$ModelPerson = Person::find()->where(['not in', 'id', $person])->all();
        
        $list_emp = ArrayHelper::map($list, 'id', 'name_card');
        return $list_emp;
        
        
    }
}