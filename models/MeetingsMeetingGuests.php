<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_meetings_meeting_guests".
 *
 * @property integer $meetings_id
 * @property integer $meeting_guests_id
 *
 * @property MeetingGuests $meetingGuests
 * @property Meetings $meetings
 */
class MeetingsMeetingGuests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_meetings_meeting_guests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meetings_id', 'meeting_guests_id'], 'required'],
            [['meetings_id', 'meeting_guests_id'], 'integer'],
            [['meeting_guests_id'], 'exist', 'skipOnError' => true, 'targetClass' => MeetingGuests::className(), 'targetAttribute' => ['meeting_guests_id' => 'id']],
            [['meetings_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meetings::className(), 'targetAttribute' => ['meetings_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'meetings_id' => Yii::t('app', 'Meetings ID'),
            'meeting_guests_id' => Yii::t('app', 'Meeting Guests ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingGuests()
    {
        return $this->hasOne(MeetingGuests::className(), ['id' => 'meeting_guests_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetings()
    {
        return $this->hasOne(Meetings::className(), ['id' => 'meetings_id']);
    }
}
