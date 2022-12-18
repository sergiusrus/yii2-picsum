<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Pic $model */

$this->title = 'Create Pic';
$this->params['breadcrumbs'][] = ['label' => 'Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
