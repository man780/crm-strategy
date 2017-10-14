<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "st_executor_authority".
 *
 * @property integer $id
 * @property string $mini_name
 * @property string $name
 * @property string $details
 * @property string $phones
 * @property string $emails
 * @property string $address
 *
 * @property EventExecutorAuthority[] $eventExecutorAuthorities
 * @property Event[] $events
 * @property ExecutorStaff[] $executorStaff
 * @property ExecutorStaff[] $getName
 */
class ExecutorAuthority extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'st_executor_authority';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'details'], 'string'],
            [['phones', 'emails', 'address', 'mini_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mini_name' => Yii::t('app', 'Mini Name'),
            'name' => Yii::t('app', 'Name'),
            'details' => Yii::t('app', 'Details'),
            'phones' => Yii::t('app', 'Phones'),
            'emails' => Yii::t('app', 'Emails'),
            'address' => Yii::t('app', 'Address'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventExecutorAuthorities()
    {
        return $this->hasMany(EventExecutorAuthority::className(), ['executor_authority_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['id' => 'event_id'])->viaTable('st_event_executor_authority', ['executor_authority_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutorStaff()
    {
        return $this->hasMany(ExecutorStaff::className(), ['exec_id' => 'id']);
    }

    public function getAutoritiesMap(){
        return ArrayHelper::map(ExecutorAuthority::find()->asArray()->all(), 'id', 'name');
    }

    public function getName($id){
        if (($model = ExecutorAuthority::findOne($id)) !== null) {
            return $model->name;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
