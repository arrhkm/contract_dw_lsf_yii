<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sp".
 *
 * @property int $id
 * @property string $jenis_sp
 * @property string $tgl_sp
 * @property int $duration_sp
 * @property int $id_employee_employee
 * @property string $employee_name
 * @property string $reg_number
 *
 * @property EmployeeEmployee $employeeEmployee
 */
class Sp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use \app\commands\SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'sp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'jenis_sp', 'tgl_sp'], 'required'],
            [['id', 'duration_sp', 'id_employee_employee'], 'default', 'value' => null],
            [['id', 'duration_sp', 'id_employee_employee'], 'integer'],
            [['tgl_sp'], 'safe'],
            [['jenis_sp', 'reg_number'], 'string', 'max' => 20],
            [['employee_name'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['id_employee_employee'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['id_employee_employee' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'jenis_sp' => 'Jenis Sp',
            'tgl_sp' => 'Tgl Sp',
            'duration_sp' => 'Duration Sp',
            'id_employee_employee' => 'Id Employee Employee',
            'employee_name' => 'Employee Name',
            'reg_number' => 'Reg Number',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'id_employee_employee']);
    }
}
