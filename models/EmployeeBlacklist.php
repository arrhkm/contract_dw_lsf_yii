<?php

namespace app\models;

use app\commands\SmartIncrementKeyDb;
use Yii;

/**
 * This is the model class for table "employee_blacklist".
 *
 * @property int $id
 * @property string $idcard
 * @property string $name
 * @property string $address
 * @property string $blacklist_date
 * @property string $dscription
 */
class EmployeeBlacklist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    
    use SmartIncrementKeyDb;
    public static function tableName()
    {
        return 'employee_blacklist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idcard'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id'], 'integer'],
            [['blacklist_date'], 'safe'],
            [['idcard'], 'string', 'max' => 30],
            [['name'], 'string', 'max' => 50],
            [['address', 'dscription'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'idcard' => 'No. KTP',
            'name' => 'Name',
            'address' => 'Address',
            'blacklist_date' => 'Blacklist Date',
            'dscription' => 'Keterangan Blacklist',
        ];
    }
}
