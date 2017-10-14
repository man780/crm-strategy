<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_broadcasting_press".
 *
 * @property integer $id
 * @property integer $execution_id
 * @property integer $event_id
 * @property integer $press_id
 * @property integer $date
 * @property integer $num
 * @property string $title
 * @property string $details
 *
 * @property Press $press
 * @property Event $event
 */
class BroadcastingPress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_broadcasting_press';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'press_id'], 'required'],
            [['event_id', 'press_id', 'date'], 'integer'],
            [['details'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['press_id'], 'exist', 'skipOnError' => true, 'targetClass' => Press::className(), 'targetAttribute' => ['press_id' => 'id']],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['execution_id'], 'exist', 'skipOnError' => true, 'targetClass' => Execution::className(), 'targetAttribute' => ['execution_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'execution_id' => Yii::t('app', 'Execution ID'),
            'event_id' => Yii::t('app', 'Event ID'),
            'press_id' => Yii::t('app', 'Press ID'),
            'date' => Yii::t('app', 'Date'),
            'num' => Yii::t('app', 'Num'),
            'title' => Yii::t('app', 'Title'),
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPress()
    {
        return $this->hasOne(Press::className(), ['id' => 'press_id']);
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
    public function getExecution()
    {
        return $this->hasOne(Execution::className(), ['id' => 'execution_id']);
    }
}
