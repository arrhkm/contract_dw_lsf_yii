<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_registeremailgroup".
 *
 * @property int $id
 * @property int $email_group_id
 * @property int $group_id
 *
 * @property EmployeeEmailgroup $emailGroup
 * @property EmployeeGroup $group
 */
class Registeremailgroup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'employee_registeremailgroup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email_group_id', 'group_id'], 'required'],
            [['email_group_id', 'group_id'], 'default', 'value' => null],
            [['email_group_id', 'group_id'], 'integer'],
            [['email_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Emailgroup::className(), 'targetAttribute' => ['email_group_id' => 'id']],
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
            'email_group_id' => 'Email Group ID',
            'group_id' => 'Group ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailgroup()
    {
        return $this->hasOne(Emailgroup::className(), ['id' => 'email_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
