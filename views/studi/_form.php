<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Studi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="studi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    $data = \app\models\Mahasiswa::find()->all();
    $data = ArrayHelper::map($data, 'id', 'name');
    echo $form->field($model, 'mahasiswa_id')->dropDownList($data,[
        'prompt'=>'-Choose a mahasiswa-',
    ]);
    ?>

    <?php
    $data = \app\models\Matakuliah::find()->all();
    $data = ArrayHelper::map($data, 'id', 'name');
    echo $form->field($model, 'matakuliah_id')->dropDownList($data,[
        'prompt'=>'-Choose a matakuliah-',
    ]);
    ?>

    <?= $form->field($model, 'nilai')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
