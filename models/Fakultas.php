<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fakultas".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Jurusan[] $jurusans
 */
class Fakultas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fakultas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['jenjang'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'jenjang' => 'Jenjang',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJurusans()
    {
        return $this->hasMany(Jurusan::className(), ['fakultas_id' => 'id']);
    }
}
