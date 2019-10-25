<?php 

namespace app\models;

use Yii;
use yii\base\Model;

class DateRangeForm extends Model{

    public $date_time_start;
    public $date_time_end;

    function rules()
    {
        return[
            [['date_time_start', 'date_time_end'], 'date', 'format'=>'php:Y-m-d'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'date_time_start' => 'Contract expired from :',
            'date_time_end'   => 'Contract expired to   :',
        ];
    }

    
}