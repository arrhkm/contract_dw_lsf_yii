<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

use yii\helpers\ArrayHelper;
/**
 * Description of JabatanList
 *
 * @author it
 */
class JabatanList {
    //put your code here
    public static function getListJabatan(){
        $model = \app\models\Jabatan::find()->all();
        
        return ArrayHelper::map($model, 'id', 'nama');
    }
}
