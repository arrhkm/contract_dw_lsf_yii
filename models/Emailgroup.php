<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_emailgroup".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 *
 * @property EmployeeRegisteremailgroup[] $employeeRegisteremailgroups
 */
class Emailgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_emailgroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['email'], 'unique'],
            [['name'], 'string', 'max' => 50],
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
            'name' => 'Name People',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeRegisteremailgroups()
    {
        return $this->hasMany(EmployeeRegisteremailgroup::className(), ['email_group_id' => 'id']);
    }
}
