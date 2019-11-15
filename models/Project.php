<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project_project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 *
 * @property ContractContract[] $contractContracts
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 225],
            [['name'], 'unique'],
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
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractContracts()
    {
        return $this->hasMany(ContractContract::className(), ['project_id' => 'id']);
    }
}
