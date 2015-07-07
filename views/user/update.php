<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserRecord */

$this->title = 'Update User Record: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
