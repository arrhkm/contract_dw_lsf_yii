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
    public function rules()
    {
        return [
            [['id', 'person_id'], 'integer'],
            [['reg_number', 'number_bpjstk', 'number_bpjskes', 'date_of_hired', 'email', 'person'], 'safe'],
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
            'date_of_hired' => $this->date_of_hired,
            'is_permanent' => $this->is_permanent,
            'person_id' => $this->person_id,
        ]);

        $query->andFilterWhere(['ilike', 'reg_number', $this->reg_number])
            ->andFilterWhere(['ilike', 'number_bpjstk', $this->number_bpjstk])
            ->andFilterWhere(['ilike', 'number_bpjskes', $this->number_bpjskes])
            ->andFilterWhere(['ilike', 'employee_person.name', $this->person])
            ->andFilterWhere(['ilike', 'email', $this->email]);

        return $dataProvider;
    }
}
