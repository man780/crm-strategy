<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_execution".
 *
 * @property integer $id
 * @property integer $exec_id
 * @property integer $exec_staff_id
 * @property integer $direction_id
 * @property integer $sub_dir_id
 * @property integer $event_id
 * @property integer $actual_mastering_finance
 * @property integer $timely_financial_security
 * @property integer $persentage
 * @property string $execution_information
 * @property string $factors_preventing_implementation
 * @property integer $seen
 * @property integer $bycreated
 * @property integer $dcreated
 * @property integer $bydeleted
 * @property integer $ddeleted
 *
 * @property BroadcastingInternet[] $broadcastingInternets
 * @property BroadcastingPress[] $broadcastingPresses
 * @property BroadcastingRadio[] $broadcastingRadios
 * @property BroadcastingTv[] $broadcastingTvs
 * @property ConfirmedExecution[] $confirmedExecutions
 * @property Direction $direction
 * @property Event $event
 * @property ExecutorAuthority $exec
 * @property ExecutorStaff $execStaff
 * @property SubDirection $subDir
 */
class Execution extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_execution';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exec_id', 'exec_staff_id', 'direction_id', 'sub_dir_id', 'event_id'], 'required'],
            [['exec_id', 'exec_staff_id', 'direction_id', 'sub_dir_id', 'event_id', 'actual_mastering_finance', 'timely_financial_security', 'persentage', 'seen', 'bycreated', 'dcreated', 'bydeleted', 'ddeleted'], 'integer'],
            [['execution_information', 'factors_preventing_implementation'], 'string'],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['exec_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExecutorAuthority::className(), 'targetAttribute' => ['exec_id' => 'id']],
            [['exec_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExecutorStaff::className(), 'targetAttribute' => ['exec_staff_id' => 'id']],
            [['sub_dir_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubDirection::className(), 'targetAttribute' => ['sub_dir_id' => 'id']],
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
            'exec_staff_id' => Yii::t('app', 'Exec Staff ID'),
            'direction_id' => Yii::t('app', 'Direction ID'),
            'sub_dir_id' => Yii::t('app', 'Sub Dir ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'actual_mastering_finance' => Yii::t('app', 'Actual Mastering Finance'),
            'timely_financial_security' => Yii::t('app', 'Timely Financial Security'),
            'persentage' => Yii::t('app', 'Persentage'),
            'execution_information' => Yii::t('app', 'Execution Information'),
            'factors_preventing_implementation' => Yii::t('app', 'Factors Preventing Implementation'),
            'seen' => Yii::t('app', 'Seen'),
            'bycreated' => Yii::t('app', 'Bycreated'),
            'dcreated' => Yii::t('app', 'Dcreated'),
            'bydeleted' => Yii::t('app', 'Bydeleted'),
            'ddeleted' => Yii::t('app', 'Ddeleted'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingInternets()
    {
        return $this->hasMany(BroadcastingInternet::className(), ['execution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingPresses()
    {
        return $this->hasMany(BroadcastingPress::className(), ['execution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingRadios()
    {
        return $this->hasMany(BroadcastingRadio::className(), ['execution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingTvs()
    {
        return $this->hasMany(BroadcastingTv::className(), ['execution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmedExecutions()
    {
        return $this->hasMany(ConfirmedExecution::className(), ['execution_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExec()
    {
        return $this->hasOne(ExecutorAuthority::className(), ['id' => 'exec_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecStaff()
    {
        return $this->hasOne(ExecutorStaff::className(), ['id' => 'exec_staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubDir()
    {
        return $this->hasOne(SubDirection::className(), ['id' => 'sub_dir_id']);
    }
}
