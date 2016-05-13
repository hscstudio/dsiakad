<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nilai".
 *
 * @property integer $id
 * @property integer $mahasiswa_id
 * @property string $ijazah
 * @property string $skripsi
 * @property integer $sks
 * @property string $nilai
 *
 * @property Mahasiswa $mahasiswa
 */
class Nilai extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nilai';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mahasiswa_id', 'ijazah', 'skripsi', 'sks', 'nilai'], 'required'],
            [['mahasiswa_id', 'sks'], 'integer'],
            [['nilai'], 'number'],
            [['ijazah'], 'string', 'max' => 50],
            [['skripsi'], 'string', 'max' => 255],
            [['mahasiswa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['mahasiswa_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mahasiswa_id' => 'Mahasiswa ID',
            'ijazah' => 'Ijazah',
            'skripsi' => 'Skripsi',
            'sks' => 'Sks',
            'nilai' => 'Nilai',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id' => 'mahasiswa_id']);
    }
}
