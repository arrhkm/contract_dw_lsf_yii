<?php

namespace app\controllers;

use app\models\Contract;
use Yii;
use app\models\Employee;
use app\models\EmployeeSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $contract = Contract::find()
        ->joinWith('contractType')
        ->where(['employee_id'=>$id]);
        $HkmDataProvider = New ActiveDataProvider([
            'query' => $contract,
            'pagination' => [
                'pageSize' => 10,
            ],
            
        ]);
        return $this->render('view', [
            'model'=>$model,
            'HkmDataProvider'=>$HkmDataProvider,
        ]);

    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();
        $model->id = $model->getLastId();
        $model->date_of_hired = date('Y-m-d');
        
        //'date_of_hired' => 
            $model->is_permanent=FALSE;
            
            //person_id,
            //status,
            //$moel->name_employee = $model->person->name;
            //$model->idcard = $model->person->idcard;
            $model->type ='DW';
            $model->status_contract = 'PKWT';
            

        if ($model->load(Yii::$app->request->post())&& $model->validate()){
            $model->reg_number= strtoupper($model->reg_number);
            if ($model->is_permanent){
                $model->status_contract='PKWTT';
            }
            if ($model->save()) {
                return $this->redirect(['index']);
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    public function actionSearch()
    {
        $searchModel = new EmployeeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('_search', [
            'model'=>$searchModel,
        ]);
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionUnregemp($id){
        $model = $this->findModel($id);
        //lepaskan id_person dari employee;
        $model->person_id ='';
        if ($model->update()){
            $this->redirect(['view', 'id'=>$model->id]);
        }
        
        //set status contarct = close 
        
    }

    /**
     * Deletes an existing Employee model.
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

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
