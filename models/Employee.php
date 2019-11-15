<?php

namespace app\models;

use app\commands\SmartIncrementKeyDb;
use Yii;

/**
 * This is the model class for table "employee_employee".
 *
 * @property int $id
 * @property string $reg_number
 * @property string $date_of_hired
 * @property bool $is_permanent
 * @property string $email
 * @property int $person_id
 * @property string $status
 * @property string $name_employee
 * @property string $idcard
 * @property string $type
 * @property string $status_contract
 *
 * @property ContractContract[] $contractContracts
 * @property EmployeePerson $person
 * @property EmployeeGroupemployee $employeeGroupemployee
 * @property Sp[] $sps
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use SmartIncrementKeyDb;

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
            [['date_of_hired'], 'safe'],
            [['is_permanent'], 'boolean'],
            [['person_id'], 'default', 'value' => null],
            [['person_id'], 'integer'],
            [['reg_number'], 'string', 'max' => 15],
            [['email'], 'string', 'max' => 100],
            [['status', 'type'], 'string', 'max' => 20],
            [['name_employee', 'dscription_out'], 'string', 'max' => 50],
            [['idcard'], 'string', 'max' => 35],
            [['status_contract'], 'string', 'max' => 10],
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
            'date_of_hired' => 'Date Of Hired',
            'is_permanent' => 'Is Permanent',
            'email' => 'Email',
            'person_id' => 'Person ID',
            'status' => 'Status',
            'name_employee' => 'Name Employee',
            'idcard' => 'Idcard',
            'type' => 'Type',
            'status_contract' => 'Status Contract',
            'dscription_out' => 'Alasan Keluar',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSps()
    {
        return $this->hasMany(Sp::className(), ['id_employee_employee' => 'id']);
    }
}
