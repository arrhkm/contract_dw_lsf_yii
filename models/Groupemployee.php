<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_groupemployee".
 *
 * @property int $id
 * @property int $employee_id
 * @property int $group_id
 *
 * @property EmployeeEmployee $employee
 * @property EmployeeGroup $group
 */
class Groupemployee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'employee_groupemployee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employee_id', 'group_id'], 'required'],
            [['employee_id', 'group_id'], 'default', 'value' => null],
            [['employee_id', 'group_id'], 'integer'],
            [['employee_id'], 'unique'],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'employee_id' => 'Employee ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
