<?php
namespace app\components;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\ArrayHelper;

class ListPerson
{
    public static function getListPersonRelatet(){
        $persons_related= \app\models\Employee::find()
                ->with('person')->all();
        $person = [];
        foreach ($persons_related as $person_related){
            array_push($person, $person_related->person_id);
        }
        
        $ModelPerson = \app\models\Person::find()->where(['not in', 'id', [$person]])->all();
        
        $list_emp = ArrayHelper::map($ModelPerson, 'id', 'name');
        return $list_emp;
    }
}