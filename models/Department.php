<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id
 * @property string $name
 * @property string $leader
 *
 * @property ContractContract[] $contractContracts
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['leader'], 'string', 'max' => 32],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'leader' => 'Leader',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractContracts()
    {
        return $this->hasMany(ContractContract::className(), ['id_department' => 'id']);
    }
}
