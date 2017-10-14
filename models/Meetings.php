<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "st_meetings".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property string $place
 * @property integer $time
 * @property integer $type
 *
 * @property MeetingsMeetingGuests[] $meetingsMeetingGuests
 * @property MeetingGuests[] $meetingGuests
 * @property MeetingsStaff[] $meetingsStaff
 * @property Staff[] $staff
 */
class Meetings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_meetings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['text', 'place'], 'string'],
            [['time', 'type'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'text' => Yii::t('app', 'Text'),
            'place' => Yii::t('app', 'Place'),
            'time' => Yii::t('app', 'Time'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingsMeetingGuests()
    {
        return $this->hasMany(MeetingsMeetingGuests::className(), ['meetings_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingGuests()
    {
        return $this->hasMany(MeetingGuests::className(), ['id' => 'meeting_guests_id'])->viaTable('st_meetings_meeting_guests', ['meetings_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingsStaff()
    {
        return $this->hasMany(MeetingsStaff::className(), ['meetings_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::className(), ['id' => 'staff_id'])->viaTable('st_meetings_staff', ['meetings_id' => 'id']);
    }

    public function getStaffAll()
    {
        return ArrayHelper::map(Staff::find()->all(), 'id', 'name');
    }

    public function getGuestsAll()
    {
        return ArrayHelper::map(MeetingGuests::find()->all(), 'id', 'name');
    }


    
    
}
