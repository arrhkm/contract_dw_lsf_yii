<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_leader".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $jabatan
 *
 * @property EmployeeGroup[] $employeeGroups
 */
class Leader extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'employee_leader';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'jabatan'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 254],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Foreman Name',
            'email' => 'Email',
            'jabatan' => 'Jabatan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeGroups()
    {
        return $this->hasMany(EmployeeGroup::className(), ['leader_id' => 'id']);
    }
}
