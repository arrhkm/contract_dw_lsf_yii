<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sp;

/**
 * SpSearch represents the model behind the search form of `app\models\Sp`.
 */
class SpSearch extends Sp
{
    
    /**
     * {@inheritdoc}
     */

    public $person;

    public function rules()
    {
        return [
            [['id', 'duration_sp', 'id_employee_employee'], 'integer'],
            [['jenis_sp', 'tgl_sp', 'employee_name', 'reg_number', 'person'], 'safe'],
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
        $query = Sp::find();
        $query->joinWith('employee')
        ->join('LEFT JOIN', 'employee_person', 'employee_person.id=employee_employee.person_id');

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
            'tgl_sp' => $this->tgl_sp,
            'duration_sp' => $this->duration_sp,
            'id_employee_employee' => $this->id_employee_employee,
        ]);

        $query->andFilterWhere(['ilike', 'jenis_sp', $this->jenis_sp])
            //->andFilterWhere(['ilike', 'employee_name', $this->employee_name])
            ->andFilterWhere(['ilike', 'reg_number', $this->reg_number])
            ->andFilterWhere(['ilike', 'employee_person.name', $this->person]);
        

        return $dataProvider;
    }
}
