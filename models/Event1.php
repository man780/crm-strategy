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
 * @property string $details
 * @property integer $deadline
 * @property string $deadline_other
 *
 * @property SubDirection $subDir
 * @property Direction $direction
 * @property EventExecutorAuthority[] $eventExecutorAuthorities
 * @property ExecutorAuthority[] $executorAuthorities
 */
class Event1 extends \yii\db\ActiveRecord
{
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
            [['direction_id', 'sub_dir_id', 'deadline'], 'integer'],
            [['event', 'details'], 'string'],
            [['deadline_other'], 'string', 'max' => 255],
            [['sub_dir_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubDirection::className(), 'targetAttribute' => ['sub_dir_id' => 'id']],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
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
            'details' => Yii::t('app', 'Details'),
            'deadline' => Yii::t('app', 'Deadline'),
            'deadline_other' => Yii::t('app', 'Deadline Other'),
        ];
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
    public function getDirection()
    {
        return $this->hasOne(Direction::className(), ['id' => 'direction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancingAmount()
    {
        return $this->hasMany(Financing::className(), ['event_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceFinancing()
    {
        return $this->hasMany(Financing::className(), ['sf_id' => 'id'])->viaTable('{{%financing}}', ['event_id' => 'id']);
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
        return $this->hasMany(ExecutorAuthority::className(), ['id' => 'executor_authority_id'])->viaTable('{{%event_executor_authority}}', ['event_id' => 'id']);
    }

    public function getExecutorsAll()
    {
        return ArrayHelper::map(ExecutorAuthority::find()->all(), 'id', 'name');
    }
}
