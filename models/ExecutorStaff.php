<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "st_executor_staff".
 *
 * @property integer $id
 * @property integer $exec_id
 * @property string $fio
 * @property string $details
 * @property string $phones
 * @property string $emails
 * @property integer $user_id
 *
 * @property Execution[] $executions
 * @property User $user
 * @property ExecutorAuthority $exec
 */
class ExecutorStaff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_executor_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exec_id', 'user_id'], 'integer'],
            [['details'], 'string'],
            [['user_id'], 'required'],
            [['fio', 'phones', 'emails'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['exec_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExecutorAuthority::className(), 'targetAttribute' => ['exec_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'exec_id' => Yii::t('app', 'Exec ID'),
            'fio' => Yii::t('app', 'Fio'),
            'details' => Yii::t('app', 'Details'),
            'phones' => Yii::t('app', 'Phones'),
            'emails' => Yii::t('app', 'Emails'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutions()
    {
        return $this->hasMany(Execution::className(), ['exec_staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExec()
    {
        return $this->hasOne(ExecutorAuthority::className(), ['id' => 'exec_id']);
    }

    public function getExecutorsAll()
    {
        return ArrayHelper::map(ExecutorAuthority::find()->all(), 'id', 'mini_name');
    }

    public function getUsersAll()
    {
        return ArrayHelper::map(Users::find()->all(), 'id', 'login');
    }
}
