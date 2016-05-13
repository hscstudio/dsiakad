<?php

namespace app\controllers;

use app\models\Fakultas;
use app\models\Jurusan;
use app\models\Mahasiswa;
use app\models\Nilai;
use app\models\Studi;

class OutputController extends \yii\web\Controller
{
    public function actionNilai()
    {
        $model = new \yii\base\DynamicModel([
            'jenjang', 'fakultas', 'jurusan', 'tahun', 'mahasiswa'
        ]);
        $model->addRule(['jenjang'], 'string');
        $model->addRule(['fakultas','jurusan','tahun','mahasiswa'], 'integer');

        return $this->render('nilai', [
            'model' => $model,
        ]);

    }

    public function actionGetFakultas($jenjang)
    {
        $fakultas = Fakultas::find()->where(['jenjang'=>$jenjang])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'fakultas' => $fakultas,
        ];
    }

    public function actionGetJurusan($fakultas)
    {
        $jurusan = Jurusan::find()->where(['fakultas_id'=>$fakultas])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'jurusan' => $jurusan,
        ];
    }

    public function actionGetTahun($jurusan)
    {
        $mahasiswa = Mahasiswa::find()->where(['jurusan_id'=>$jurusan])->groupBy('tahun')->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'mahasiswa' => $mahasiswa,
        ];
    }

    public function actionGetMahasiswa($tahun,$jurusan)
    {
        $mahasiswa = Mahasiswa::find()->where([
            'jurusan_id'=>$jurusan,
            'tahun'=>$tahun,
        ])->all();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'mahasiswa' => $mahasiswa,
        ];
    }

    public function actionGetNilai($mahasiswa_id)
    {
        $mahasiswa = Mahasiswa::findOne($mahasiswa_id);
        $nilai = Nilai::find()->where(['mahasiswa_id'=>$mahasiswa_id])->one();
        $studis = Studi::find()->where(['mahasiswa_id'=>$mahasiswa_id])->all();

        return $this->renderAjax('_nilai', [
            'mahasiswa' => $mahasiswa,
            'nilai' => $nilai,
            'studis' => $studis,
        ]);
    }
}
