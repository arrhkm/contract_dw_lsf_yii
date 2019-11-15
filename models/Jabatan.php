<?php

namespace app\models;

use app\commands\SmartIncrementKeyDb;
use Yii;

/**
 * This is the model class for table "contract_jabatan".
 *
 * @property int $id
 * @property string $nama
 *
 * @property ContractContract[] $contractContracts
 */
class Jabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use SmartIncrementKeyDb;

    public static function tableName()
    {
        return 'contract_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractContracts()
    {
        return $this->hasMany(ContractContract::className(), ['jabatan_id' => 'id']);
    }

    
}
