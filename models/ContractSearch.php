<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contract;

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
    public function rules()
    {
        return [
            [['id', 'contract_distance', 'jabatan_id', 'contract_type_id', 'employee_id', 'project_id'], 'integer'],
            [
                [
                    'number_contract', 'doc_date', 'start_date', 'end_date', 'corporate_name', 
                    'corporate_address', 'jenis_usaha', 'cara_pembayaran', 'tempat_aggrement', 
                    'pejabat_acc', 'status', 'employee', 'person',
                ],
                'safe'
            ],
            [['besar_upah'], 'number'],
            
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
    public function search($params)
    {
        $query = Contract::find();
        $query->joinWith('employee')//('LEFT JOIN', 'employee_employee', 'employee_employee.id = contract_contract.employee_id');
        ->join('RIGHT JOIN', 'employee_person', 'employee_person.id = employee_employee.person_id');

        
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'doc_date' => $this->doc_date,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
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
            ->andFilterWhere(['ilike', 'status', $this->status]);
        $query->andFilterWhere(['ilike', 'employee_person.name', $this->person]);
        $query->andFilterWhere(['ilike', 'employee_employee.reg_number', $this->employee]);
        

        return $dataProvider;
    }
}
