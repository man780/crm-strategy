<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_broadcasting_radio".
 *
 * @property integer $id
 * @property integer $event_id
 * @property integer $execution_id
 * @property integer $radio_id
 * @property integer $date
 * @property string $title
 * @property string $details
 *
 * @property Radio $radio
 * @property Event $event
 */
class BroadcastingRadio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_broadcasting_radio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id', 'radio_id', 'execution_id'], 'required'],
            [['event_id', 'radio_id', 'date'], 'integer'],
            [['details'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['radio_id'], 'exist', 'skipOnError' => true, 'targetClass' => Radio::className(), 'targetAttribute' => ['radio_id' => 'id']],
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
            'radio_id' => Yii::t('app', 'Radio ID'),
            'date' => Yii::t('app', 'Date'),
            'title' => Yii::t('app', 'Title'),
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRadio()
    {
        return $this->hasOne(Radio::className(), ['id' => 'radio_id']);
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
