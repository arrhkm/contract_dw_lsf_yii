<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\commands;

/**
 * Description of DateRange
 *
 * @author it
 */
class DateRange {
    
    public static function getRangeValueFromNow($date_param){
        $date_now = date_create(date('Y-m-d'));
        $date_target = date_create($date_param);
        $diff = date_diff($date_now, $date_target);       
        return $diff->format('%R%a');        
    }
}
