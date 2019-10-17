<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_employee".
 *
 * @property int $id
 * @property string $reg_number
 * @property string $number_bpjstk
 * @property string $number_bpjskes
 * @property string $date_of_hired
 * @property bool $is_permanent
 * @property string $email
 * @property int $person_id
 *
 * @property ContractContract[] $contractContracts
 * @property EmployeePerson $person
 * @property EmployeeGroupemployee $employeeGroupemployee
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee_employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['reg_number', 'date_of_hired', 'is_permanent'], 'required'],
            [['id', 'person_id'], 'unique'],
            [['date_of_hired'], 'safe'],
            [['is_permanent'], 'boolean'],
            [['person_id'], 'default', 'value' => null],
            [['person_id'], 'integer'],
            [['reg_number'], 'string', 'max' => 15],
            [['number_bpjstk', 'number_bpjskes'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 100],
            [['reg_number'], 'unique'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reg_number' => 'Reg Number',
            'number_bpjstk' => 'Number Bpjstk',
            'number_bpjskes' => 'Number Bpjskes',
            'date_of_hired' => 'Date Of Hired',
            'is_permanent' => 'Is Permanent',
            'email' => 'Email',
            'person_id' => 'Person ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContracts()
    {
        return $this->hasMany(Contract::className(), ['employee_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupemployee()
    {
        return $this->hasOne(Groupemployee::className(), ['employee_id' => 'id']);
    }
}
