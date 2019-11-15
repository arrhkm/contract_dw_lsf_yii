<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contract;

use kartik\daterange\DateRangeBehavior;

/**
 * ContractSearch represents the model behind the search form of `app\models\Contract`.
 */
class ContractSearch extends Contract
{
    /**
     * {@inheritdoc}
     */
    public $employee;
    public $person;
    public $group;
    public $leader;
    public $contract_type;
    

    //variable time kartik range 
    public $createTimeRange;
    public $createTimeStart;
    public $createTimeEnd;
    //end Time Range 

    /*public function behaviors()
    {
       return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'createTimeRange',
                'dateStartAttribute' => 'createTimeStart',
                'dateEndAttribute' => 'createTimeEnd',
            ]
        ];
    }*/


    public function rules()
    {
        return [
            //[['createTimeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['createTimeStart', 'createTimeEnd'], 'date'],
            [['id', 'contract_distance', 'jabatan_id', 'contract_type_id', 'employee_id', 'project_id'], 'integer'],
            [
                [
                    'number_contract', 'doc_date', 'start_date', 'end_date', 'corporate_name', 
                    'corporate_address', 'jenis_usaha', 'cara_pembayaran', 'tempat_aggrement', 
                    'pejabat_acc', 'status', 'employee', 'person', 'createTimeStart', 'createTimeEnd',
                    'group', 'leader', 'contract_type',
                ],
                'safe'
            ],
            [['besar_upah'], 'number'],
            
            
        ];
    }


    public function attributeLabels()
    {
        return [
            'leader' => 'Foreman',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params, $date_start= NULL, $date_end=NULL)
    {
        $query = Contract::find();
        $query->join('LEFT JOIN', 'employee_employee', 'employee_employee.id=contract_contract.employee_id')
            ->join('LEFT JOIN', 'employee_person', 'employee_person.id = employee_employee.person_id')
            ->join('LEFT JOIN', 'employee_groupemployee',  'employee_groupemployee.employee_id = employee_employee.id')
            ->join('LEFT JOIN', 'employee_group', 'employee_group.id = employee_groupemployee.group_id');
        $query->join('LEFT JOIN', 'employee_leader', 'employee_leader.id = employee_group.leader_id');
        $query->join('LEFT JOIN', 'contract_contracttype', 'contract_contracttype.id = contract_contract.contract_type_id');


        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            //$query->where('0=1');
            return $dataProvider;
        }

        

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doc_date' => $this->doc_date,
            //'start_date' => $this->start_date,
            //'end_date' => $this->end_date,
            'contract_distance' => $this->contract_distance,
            'besar_upah' => $this->besar_upah,
            'jabatan_id' => $this->jabatan_id,
            'contract_type_id' => $this->contract_type_id,
            'employee_id' => $this->employee_id,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['ilike', 'number_contract', $this->number_contract])
            ->andFilterWhere(['ilike', 'corporate_name', $this->corporate_name])
            ->andFilterWhere(['ilike', 'corporate_address', $this->corporate_address])
            ->andFilterWhere(['ilike', 'jenis_usaha', $this->jenis_usaha])
            ->andFilterWhere(['ilike', 'cara_pembayaran', $this->cara_pembayaran])
            ->andFilterWhere(['ilike', 'tempat_aggrement', $this->tempat_aggrement])
            ->andFilterWhere(['ilike', 'pejabat_acc', $this->pejabat_acc]) 
            ->andFilterWhere(['ilike', 'contract_contracttype.contract_name', $this->contract_type])              
            ->andFilterWhere(['ilike', 'contract_contract.status', $this->status]);
        $query->andFilterWhere(['ilike', 'employee_person.name', $this->person]);
        $query->andFilterWhere(['ilike', 'employee_employee.reg_number', $this->employee]);
        $query->andFilterWhere(['ilike', 'employee_group.name', $this->group]);
        $query->andFilterWhere(['ilike', 'employee_leader.name', $this->leader]);
        //$query->andFilterWhere(['employee_groupemployee.group_id'=> $this->group]);
        if (isset($date_start) && isset($date_end)){            
            $query->andWhere(['BETWEEN', 'end_date', $date_start, $date_end]);
        }
       

        return $dataProvider;
    }
}
