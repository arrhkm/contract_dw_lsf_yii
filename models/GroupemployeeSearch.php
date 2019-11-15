<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Groupemployee;

/**
 * GroupemployeeSearch represents the model behind the search form of `app\models\Groupemployee`.
 */
class GroupemployeeSearch extends Groupemployee
{
    /**
     * {@inheritdoc}
     */
    public $person;
    public $leader;
    public $group;
    public $reg_number;
    public $src_leader;


    public function rules()
    {
        return [
            [['id', 'employee_id', 'group_id'], 'integer'],
            [['person', 'group', 'reg_number', 'src_leader'], 'safe'],

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
    public function search($params, $id=Null)
    {
        $query = Groupemployee::find();
        $query->joinWith('employee');
        $query->joinWith('group');
        $query->join('LEFT JOIN', 'employee_person', 'employee_person.id=employee_employee.person_id');
        $query->join('LEFT JOIN', 'employee_leader', 'employee_leader.id = employee_group.leader_id');
        
        if(isset($id)){
            $query->andWhere(['group_id'=>$id]);
        }
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
            'employee_id' => $this->employee_id,
            
            'group_id' => $this->group_id,
        ]);
        $query->andFilterWhere(['ilike', 'employee_employee.reg_number', $this->reg_number,]);
        $query->andFilterWhere(['ilike', 'employee_group.name', $this->group]);
        $query->andFilterWhere(['ilike', 'employee_person.name', $this->person]);
        $query->andFilterWhere(['ilike', 'employee_leader.name', $this->src_leader]);

        return $dataProvider;
    }
}
