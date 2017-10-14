<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_meeting_guests".
 *
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property string $organization
 *
 * @property MeetingsMeetingGuests[] $meetingsMeetingGuests
 * @property Meetings[] $meetings
 */
class MeetingGuests extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_meeting_guests';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position', 'organization'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'position' => Yii::t('app', 'Position'),
            'organization' => Yii::t('app', 'Organization'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingsMeetingGuests()
    {
        return $this->hasMany(MeetingsMeetingGuests::className(), ['meeting_guests_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetings()
    {
        return $this->hasMany(Meetings::className(), ['id' => 'meetings_id'])->viaTable('st_meetings_meeting_guests', ['meeting_guests_id' => 'id']);
    }
}
