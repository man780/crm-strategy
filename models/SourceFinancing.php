<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "st_source_financing".
 *
 * @property integer $id
 * @property string $name
 * @property string $details
 *
 * @property Financing[] $financings
 */
class SourceFinancing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%source_financing}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['details'], 'string'],
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
            'details' => Yii::t('app', 'Details'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFinancings()
    {
        return $this->hasMany(Financing::className(), ['sf_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource($id)
    {
        return $this->hasMany(Financing::className(), ['sf_id' => 'id']);
    }
}
