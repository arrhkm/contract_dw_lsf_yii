<?php

namespace app\controllers;

use Yii;
use app\models\Contract;
use app\models\ContractSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\helpers\ArrayHelper;
use app\models\Employee;
use app\commands\DateRange;
use app\components\ContractProgress;
use yii\data\ArrayDataProvider;
use DateInterval;
use app\models\DateRangeForm;

use yii\db\Query;

/**
 * ContractController implements the CRUD actions for Contract model.
 */
class ContractController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Contract models.
     * @return mixed
     */
    public function actionIndex()
    {

        $model_form = New DateRangeForm();
        $searchModel = new ContractSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model_form->load(Yii::$app->request->post()) && $model_form->validate()){
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model_form->date_time_start, $model_form->date_time_end);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'model_form' => $model_form,
            ]);
        }
     


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model_form' => $model_form,
        ]);
    }

    /**
     * Displays a single Contract model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contract model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Contract();
        $model->id = $model->getLastId();

        if ($model->load(Yii::$app->request->post())) {
            if (isset($model->employee_id)){
                $employee = Employee::findOne(['id'=>$model->employee_id]);
                if ($model->status=='PKWTT'){                    
                    $employee->is_permanent = TRUE;
                    $employee->status_contract='PKWTT';
                    $employee->update();
                }else {
                    $employee->is_permanent = FALSE;
                    $employee->status_contract='PKWT';
                    $employee->update();
                }
                
            }
            if ($model->save()){    
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Contract model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if (isset($model->employee_id)){
                $employee = Employee::findOne(['id'=>$model->employee_id]);
                if ($model->status=='PKWTT'){                    
                    $employee->is_permanent = TRUE;
                    $employee->status_contract='PKWTT';
                    $employee->update();
                }else {
                    $employee->is_permanent = FALSE;
                    $employee->status_contract='PKWT';
                    $employee->update();
                }
                
            }
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contract model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    //begin
    public function actionContractcek(){
        $dt_contract = [];
        $contracts = 0;
        //$modelEmp = \common\models\Employee::find()->all();
        //$contracts= Contract::find()->where(['id_employee'=>241])->orderBy(['end_date'=>SORT_DESC])->limit(1)->all();
        foreach (Employee::find()->all() as $emp){
            $modelContract = Contract::find()->where(['employee_id'=>$emp->id,  'status'=>'active']);
            
            if ($modelContract->exists()){
                $contracts = (new \yii\db\Query())
                    ->select(['id', 'number_contract'])
                    ->from('contract_contract')
                    ->where(['employee_id' => $emp->id])                    
                    ->limit(1)
                    ->orderBy(['end_date'=>SORT_DESC])
                    ->all();
                //cek contract expired 
                //$date_now= date('Y-m-d');
                
                
                $contracts=Contract::find()
                    ->where(['employee_id'=>$emp->id, 'status'=>'active'])
                    ->orderBy(['end_date'=>SORT_DESC])
                    ->limit(1)->all();
                $date_contract = $contracts[0]['end_date'];
                $jedah = DateRange::getRangeValueFromNow($date_contract);
                if ($jedah >=-30 && $jedah<30){
                    if (isset ($contracts[0]['end_date'])){
                        array_push($dt_contract, [
                            'employee_id'=>$emp->id,
                            'name'=>$emp->person->name, 
                            'id'=>$contracts[0]['id'],
                            'number_contract'=>$contracts[0]['number_contract'],
                            'start_date'=>$contracts[0]['start_date'],
                            'end_date'=>$contracts[0]['end_date'],
                            'jedah'=>$jedah,
                        ]);
                    }
                }
            }                    
            
        }
        $provider = New ArrayDataProvider([
            'allModels'=>$dt_contract,
            'pagination' => [
                'pageSize' => 1000,
            ],
        ]);
        
        return $this->render('contractcek', [
            //'employee'=>$modelEmp,
            'contracts'=>$contracts,
            'provider'=>$provider,
            
        ]);
    }
    
    public function actionExpiredcontract($interval_day=30){
        $today = date_create(date('Y-m-d'));
        $today_str = date_format($today,"Y-m-d");
        $interval_str = "P".$interval_day."D";
        $interval = new DateInterval($interval_str);
        
        $end_date = $today->add($interval);
        $end_date_str = date_format($end_date,'Y-m-d');
        //------------------------------------------
                       
        $model = Contract::find()->with('employee')        
        ->where(            
            [
                'between',
                'contract_contract.end_date',
                $today_str,
                $end_date_str,
            ]
        )
        ->andFilterWhere(['contract_contract.status' => 'notified'])
        ;
        
        return $this->render('expiredcontract',[
            'today'=>$today,
            'interval'=>$interval,
            'end_date'=>$end_date,
            'today_str'=>$today_str,
            'end_date_str'=>$end_date_str,
            'model'=>$model,
        ]);
        
    }
    //end

    public function actionUrutkan(){
        $model = Employee::find()->all();
        foreach ($model as $models){
            $urut = New ContractProgress($models->id);
            $urut->urutkan();
        }

        

        $provider = New ArrayDataProvider([
            'allModels'=> $model,
        ]);
        
        return $this->render('urutkan', ['provider'=>$provider]);
    }

    /**
     * Finds the Contract model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contract the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contract::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
