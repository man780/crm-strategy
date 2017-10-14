<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "st_event".
 *
 * @property integer $id
 * @property integer $direction_id
 * @property integer $sub_dir_id
 * @property string $event
 * @property string $mechanism
 * @property string $details
 * @property string $percentage
 * @property string $status
 * @property integer $deadline
 * @property string $deadline_other
 * @property integer $main_exec_id
 *
 * @property BroadcastingInternet[] $broadcastingInternets
 * @property BroadcastingPress[] $broadcastingPresses
 * @property BroadcastingRadio[] $broadcastingRadios
 * @property BroadcastingTv[] $broadcastingTvs
 * @property Direction $direction
 * @property SubDirection $subDir
 * @property EventExecutorAuthority[] $eventExecutorAuthorities
 * @property Execution[] $executions
 * @property Financing[] $financings
 */
class Event extends \yii\db\ActiveRecord
{
    public $executorAuthority;
    //public $name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direction_id', 'sub_dir_id'], 'required'],
            [['direction_id', 'sub_dir_id', 'main_exec_id'], 'integer'],
            [['event', 'details'], 'string'],
            [['deadline_other', 'mechanism'], 'string', 'max' => 255],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
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
            'direction_id' => Yii::t('app', 'Direction ID'),
            'sub_dir_id' => Yii::t('app', 'Sub Dir ID'),
            'event' => Yii::t('app', 'Event'),
            'details' => Yii::t('app', 'EDetails'),
            'deadline' => Yii::t('app', 'Deadline'),
            'deadline_other' => Yii::t('app', 'Deadline Other'),
            'main_exec_id' => Yii::t('app', 'Main Exec ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingInternets()
    {
        return $this->hasMany(BroadcastingInternet::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingPresses()
    {
        return $this->hasMany(BroadcastingPress::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingRadios()
    {
        return $this->hasMany(BroadcastingRadio::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastingTvs()
    {
        return $this->hasMany(BroadcastingTv::className(), ['event_id' => 'id']);
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
    public function getSubDir()
    {
        return $this->hasOne(SubDirection::className(), ['id' => 'sub_dir_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventExecutorAuthorities()
    {
        return $this->hasMany(EventExecutorAuthority::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorAuthorities()
    {
        return $this->hasMany(ExecutorAuthority::className(), ['id' => 'executor_authority_id'])->
        viaTable(
            '{{%event_executor_authority}}', ['event_id' => 'id'],
            function ($query) {
                $query->orderBy(['sequence_exec' => SORT_DESC]);
            }
        );
    }

    public function getExecutorAuthoritiesBySec()
    {
        return $this->hasMany(EventExecutorAuthority::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutions()
    {
        return $this->hasMany(Execution::className(), ['event_id' => 'id'])->orderBy(['dcreated'=>SORT_DESC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfirmedExecutions()
    {
        return $this->hasMany(ConfirmedExecution::className(), ['event_id' => 'id'])->orderBy(['dcreated' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancings()
    {
        return $this->hasMany(Financing::className(), ['event_id' => 'id']);
    }

    public function getExecutorsAll()
    {
        return ArrayHelper::map(ExecutorAuthority::find()->all(), 'id', 'name');
    }
}
