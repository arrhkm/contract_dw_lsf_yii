<?php

namespace app\models;

use app\commands\SmartIncrementKeyDb;
use Yii;

/**
 * This is the model class for table "contract_contract".
 *
 * @property int $id
 * @property string $number_contract
 * @property string $doc_date
 * @property string $start_date
 * @property string $end_date
 * @property int $contract_distance
 * @property string $besar_upah
 * @property string $corporate_name
 * @property string $corporate_address
 * @property string $jenis_usaha
 * @property int $jabatan_id
 * @property string $cara_pembayaran
 * @property string $tempat_aggrement
 * @property string $pejabat_acc
 * @property int $contract_type_id
 * @property int $employee_id
 * @property int $project_id
 * @property string $status
 *
 * @property ContractContracttype $contractType
 * @property ContractJabatan $jabatan
 * @property EmployeeEmployee $employee
 * @property ProjectProject $project
 */
class Contract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    use SmartIncrementKeyDb;
    
    public static function tableName()
    {
        return 'contract_contract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number_contract', 'contract_distance', 'contract_type_id', 'employee_id', 'status'], 'required'],
            [['doc_date', 'start_date', 'end_date'], 'safe'],
            [['contract_distance', 'jabatan_id', 'contract_type_id', 'employee_id', 'project_id', 'id_department'], 'default', 'value' => null],
            [['contract_distance', 'jabatan_id', 'contract_type_id', 'employee_id', 'project_id', 'id_department'], 'integer'],
            [['besar_upah'], 'number'],
            [['number_contract', 'corporate_name', 'corporate_address', 'tempat_aggrement', 'pejabat_acc'], 'string', 'max' => 100],
            [['jenis_usaha', 'cara_pembayaran', 'status'], 'string', 'max' => 50],
            //[['status_contract'], 'string', 'max' => 10],
            [['contract_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contracttype::className(), 'targetAttribute' => ['contract_type_id' => 'id']],
            [['id_department'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['id_department' => 'id']],
            [['jabatan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jabatan::className(), 'targetAttribute' => ['jabatan_id' => 'id']],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_contract' => 'Number Contract',
            'doc_date' => 'Doc Date',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'contract_distance' => 'durasi',
            'besar_upah' => 'Besar Upah',
            'corporate_name' => 'Corporate Name',
            'corporate_address' => 'Corporate Address',
            'jenis_usaha' => 'Jenis Usaha',
            'jabatan_id' => 'Jabatan ID',
            'cara_pembayaran' => 'Cara Pembayaran',
            'tempat_aggrement' => 'Tempat Aggrement',
            'pejabat_acc' => 'Pejabat Acc',
            'contract_type_id' => 'Contract Type ID',
            'employee_id' => 'Employee ID',
            'project_id' => 'Project ID',
            'status' => 'Status',
            'id_department' => 'Id Department',
            //'status_contract'=>'Status Cotract',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContractType()
    {
        return $this->hasOne(Contracttype::className(), ['id' => 'contract_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJabatan()
    {
        return $this->hasOne(Jabatan::className(), ['id' => 'jabatan_id']);
    }

    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'id_department']);
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
}
