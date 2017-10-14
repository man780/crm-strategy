<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_sub_event".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $direction_id
 * @property integer $sub_dir_id
 * @property string $event
 * @property string $mechanism
 * @property string $details
 * @property integer $deadline
 * @property string $deadline_other
 * @property integer $percentage
 * @property integer $status
 *
 * @property SubDirection $subDir
 * @property Direction $direction
 * @property Event $event0
 */
class SubEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_sub_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'direction_id'], 'required'],
            [['event_id', 'direction_id', 'sub_dir_id', 'deadline', 'percentage', 'status'], 'integer'],
            [['details'], 'string'],
            [['event', 'mechanism', 'deadline_other'], 'string', 'max' => 255],
            [['sub_dir_id'], 'exist', 'skipOnError' => true, 'targetClass' => SubDirection::className(), 'targetAttribute' => ['sub_dir_id' => 'id']],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Direction::className(), 'targetAttribute' => ['direction_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'direction_id' => Yii::t('app', 'Direction ID'),
            'sub_dir_id' => Yii::t('app', 'Sub Dir ID'),
            'event' => Yii::t('app', 'Event'),
            'mechanism' => Yii::t('app', 'Mechanism'),
            'details' => Yii::t('app', 'Details'),
            'deadline' => Yii::t('app', 'Deadline'),
            'deadline_other' => Yii::t('app', 'Deadline Other'),
            'percentage' => Yii::t('app', 'Percentage'),
            'status' => Yii::t('app', 'Status'),
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
    public function getEvent0()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }
}
