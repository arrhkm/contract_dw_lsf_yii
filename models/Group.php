<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_group".
 *
 * @property int $id
 * @property string $name
 * @property int $leader_id
 *
 * @property EmployeeLeader $leader
 * @property EmployeeGroupemployee[] $employeeGroupemployees
 * @property EmployeeRegisteremailgroup[] $employeeRegisteremailgroups
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'employee_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'leader_id'], 'required'],
            [['leader_id'], 'default', 'value' => null],
            [['leader_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['leader_id'], 'exist', 'skipOnError' => true, 'targetClass' => Leader::className(), 'targetAttribute' => ['leader_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Group Foreman Name',
            'leader_id' => 'Leader ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLeader()
    {
        return $this->hasOne(Leader::className(), ['id' => 'leader_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupemployees()
    {
        return $this->hasMany(Groupemployee::className(), ['group_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegisteremailgroups()
    {
        return $this->hasMany(Registeremailgroup::className(), ['group_id' => 'id']);
    }

    public function getEmailgroup()
    {
        return $this->hasOne(Emailgroup::className(), ['id' => 'email_group_id'])->viaTable('employee_registeremailgroup',['group_id'=>'id']);
    }
}
