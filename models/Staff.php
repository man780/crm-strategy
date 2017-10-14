<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_staff".
 *
 * @property integer $id
 * @property string $name
 * @property string $position
 *
 * @property MeetingsStaff[] $meetingsStaff
 * @property Meetings[] $meetings
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'position'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingsStaff()
    {
        return $this->hasMany(MeetingsStaff::className(), ['staff_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetings()
    {
        return $this->hasMany(Meetings::className(), ['id' => 'meetings_id'])->viaTable('st_meetings_staff', ['staff_id' => 'id']);
    }
}
