<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */
    public $person;
    public $group;
    public $bpjs_kes;
    public $bpjs_tk;

    public function rules()
    {
        return [
            [['id', 'person_id'], 'integer'],
            [
                ['reg_number', 'date_of_hired', 'bpjs_kes', 'bpjs_tk', 'email', 'person', 'group', 'status', 'type', 'status_contract'],
                'safe'
            ],
            [['is_permanent'], 'boolean'],
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
        $query = Employee::find();
        $query->joinWith('person');
        $query->joinWith('groupemployee');
        $query->join('left join', 'employee_group', 'employee_group.id=employee_groupemployee.group_id');
        

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize'=>5],
            'sort' => [
                'defaultOrder' => [
                    'reg_number' => SORT_ASC,                    
                ]
            ],
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
            'date_of_hired' => $this->date_of_hired,
            'is_permanent' => $this->is_permanent,
            'person_id' => $this->person_id,
            

        ]);
        //$query->andWhere(['<>', 'status', 'out']);

        $query->andFilterWhere(['ilike', 'reg_number', $this->reg_number])           
            ->andFilterWhere(['ilike', 'employee_person.name', $this->person])
            ->andFilterWhere(['ilike', 'status', $this->status])
            ->andFilterWhere(['ilike', 'type', $this->type])
            ->andFilterWhere(['ilike', 'status_contract', $this->status_contract])
            ->andFilterWhere(['ilike', 'employee_person.no_bpjs_kesehatan', $this->bpjs_kes])
            ->andFilterWhere(['ilike', 'employee_person.no_bpjs_tenaga_kerja', $this->bpjs_tk])
            ->andFilterWhere(['ilike', 'employee_group.name', $this->group])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
