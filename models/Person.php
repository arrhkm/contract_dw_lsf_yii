<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employee_person".
 *
 * @property int $id
 * @property string $idcard
 * @property string $name
 * @property string $birth_of_date
 * @property string $birth_city
 * @property string $phone
 * @property string $address
 * @property string $bank_account
 * @property bool $marital
 * @property string $gender
 * @property string $tax_account
 * @property string $city
 *
 * @property EmployeeEmployee[] $employeeEmployees
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    
    
    
    

    public static function tableName()
    {
        return 'employee_person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'marital', 'gender'], 'required'],
            [['birth_of_date'], 'safe'],
            [['marital'], 'boolean'],
            [['idcard'], 'string', 'max' => 35],
            [['name', 'birth_city', 'address', 'city', 'district'], 'string', 'max' => 100],
            [['phone', 'bank_account', 'tax_account'], 'string', 'max' => 20],
            [['no_bpjs_kesehatan', 'no_bpjs_tenaga_kerja'], 'string', 'max' => 50],
            [['gender'], 'string', 'max' => 1],
            [['idcard'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcard' => 'Idcard',
            'name' => 'Name',
            'birth_of_date' => 'Birth Of Date',
            'birth_city' => 'Birth City',
            'phone' => 'Phone',
            'address' => 'Address',
            'bank_account' => 'Bank Account',
            'marital' => 'Marital',
            'gender' => 'Gender',
            'tax_account' => 'Tax Account',
            'city' => 'City',
            'district'=> 'Kecamatan',
            'no_bpjs_kesehatan' => 'No. BPJS Kesehatan',
            'no_bpjs_tenaga_kerja'=>'No. BPJS Tenaga Keraja',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeEmployees()
    {
        return $this->hasMany(EmployeeEmployee::className(), ['person_id' => 'id']);
    }
    
    
}
