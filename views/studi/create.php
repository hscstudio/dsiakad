<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Studi */

$this->title = 'Create Studi';
$this->params['breadcrumbs'][] = ['label' => 'Studis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
