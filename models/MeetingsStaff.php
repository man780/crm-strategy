<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_meetings_staff".
 *
 * @property integer $meetings_id
 * @property integer $staff_id
 *
 * @property Staff $staff
 * @property Meetings $meetings
 */
class MeetingsStaff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_meetings_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meetings_id', 'staff_id'], 'required'],
            [['meetings_id', 'staff_id'], 'integer'],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::className(), 'targetAttribute' => ['staff_id' => 'id']],
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
            'staff_id' => Yii::t('app', 'Staff ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::className(), ['id' => 'staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetings()
    {
        return $this->hasOne(Meetings::className(), ['id' => 'meetings_id']);
    }
}
