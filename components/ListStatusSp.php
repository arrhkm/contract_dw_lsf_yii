<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

/**
 * Description of ListStatusSp
 *
 * @author it
 */
class ListStatusSp {
    //put your code here
    public static function getList(){
        $list = ['LISAN', 'TERTULIS', 'SP1', 'SP2', 'SP3'];
        return $list;
    }
}
