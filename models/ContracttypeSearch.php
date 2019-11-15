<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contracttype;

/**
 * ContracttypeSearch represents the model behind the search form of `app\models\Contracttype`.
 */
class ContracttypeSearch extends Contracttype
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['contract_name', 'contract_description'], 'safe'],
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
        $query = Contracttype::find();

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
        ]);

        $query->andFilterWhere(['ilike', 'contract_name', $this->contract_name])
            ->andFilterWhere(['ilike', 'contract_description', $this->contract_description]);

        return $dataProvider;
    }
}
