<?php

namespace app\controllers;

use Yii;
use app\models\Group;
use app\models\GroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Leader;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;


/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends Controller
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

    public function getLeaderList(){
        $leader = Leader::find()->all();
        $leader_list = ArrayHelper::map($leader, 'id','name');
        return $leader_list;
    }
    
    /**
     * Lists all Group models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Group model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new \app\models\GroupemployeeSearch();        
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $id);
        
        $searchModel2 = new \app\models\RegisteremailgroupSearch();
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams, $id);
        
        
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$dataProvider,
            'dataProvider2'=>$dataProvider2,
        ]);
    }
    
    public function actionDeleteemp($id)
    {
        $GroupEmployee = \app\models\Groupemployee::findOne($id);
        $id = $GroupEmployee->id;
        $employee_id = $GroupEmployee->employee_id;
        $group_id = $GroupEmployee->group_id;
        $data = ['id'=>$id, 'employee_id'=>$employee_id, 'group_id'=>$group_id];
        //var_dump($data);
        if ($GroupEmployee->delete()){
            return $this->redirect(['view', 'id'=>$group_id]);
        }   
    }
    
    public function actionDeleteregisteremailgroup($id){
        
        $model = \app\models\Registeremailgroup::findOne($id);
        $group_id = $model->group_id;
        if ($model->delete()){
            return $this->redirect(['view', 'id'=>$group_id]);
        }
    }

    public function actionAddemp($id){
        $model = New \app\models\Groupemployee();
        $model->id = $model->getLastId();
        $model->group_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['view', 'id'=>$model->group_id]);
        } 
        
        return $this->render('addemp', [
            'model'=>$model,
        ]);
    }
    
    public function actionRegisteremailgroup($id){
        $model = new \app\models\Registeremailgroup();
        $model->id = $model->getLastId();
        $model->group_id = $id;
        if($model->load(Yii::$app->request->post())&& $model->save()){
            return $this->redirect(['view', 'id'=>$id]);
        }
        return $this->render('registeremailgroup', [
            'model'=>$model,
        ]);
        
    }
    /**
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Group();

        $leader = Leader::find()->all();
        $leader_list = ArrayHelper::map($leader, 'id','name');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'leader_list'=>$leader_list,
            
        ]);
    }
    
    public function actionAddleader(){
        
    }
    
    public function actionUnregleader($id){
        $model = $this->findModel($id);
        $model->leader_id = NULL;
        $model->update();
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $leader = Leader::find()->all();
        $leader_list = ArrayHelper::map($leader, 'id','name');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'leader_list'=>$leader_list,
        ]);
    }

    /**
     * Deletes an existing Group model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model_grouemployee = \app\models\Groupemployee::deleteAll(['group_id'=>$id]);
        $model_regemail = \app\models\Registeremailgroup::deleteAll(['group_id'=>$id]);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
