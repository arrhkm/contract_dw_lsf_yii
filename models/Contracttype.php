<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contract_contracttype".
 *
 * @property int $id
 * @property string $contract_name
 * @property string $contract_description
 *
 * @property ContractContract[] $contractContracts
 */
class Contracttype extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'contract_contracttype';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contract_name', 'contract_description'], 'required'],
            [['contract_name'], 'string', 'max' => 20],
            [['contract_description'], 'string', 'max' => 255],
            [['contract_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contract_name' => 'Contract Name',
            'contract_description' => 'Contract Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractContracts()
    {
        return $this->hasMany(Contract::className(), ['contract_type_id' => 'id']);
    }
}
