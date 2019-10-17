<?php
namespace app\commands;

use yii\console\Controller;
/**
 * Description of CobaController
 *
 * @author it
 */
class CobaController extends Controller{
    //put your code here
    
    public $message;
    
    public function options($actionID)
    {
        return ['message'];
    }
    
    public function optionAliases()
    {
        return [
            'm' => 'message',
            'p' => 'Aku sednag print',
        ];
    }
    
    
    
    public function actionIndex()
    {
        echo $this->message . "\n";
    }
    
    public function actionTest($message){
        echo "\n Ini adalah percobaan :".$message." \n";
    }

}
