<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Registeremailgroup;

/**
 * RegisteremailgroupSearch represents the model behind the search form of `app\models\Registeremailgroup`.
 */
class RegisteremailgroupSearch extends Registeremailgroup
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'email_group_id', 'group_id'], 'integer'],
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
    public function search($params, $id=NUll)
    {
        $query = Registeremailgroup::find();
        
        if (isset($id)){
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
            'email_group_id' => $this->email_group_id,
            'group_id' => $this->group_id,
        ]);

        return $dataProvider;
    }
}
