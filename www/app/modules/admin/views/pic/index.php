<?php

use app\models\Pic;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\PicSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Pics';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pic-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pic', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'image_id',
            [
                'attribute' => 'is_approved',
                'format' => 'raw',
                'value' => function ($model) {
                    return '<input onchange="changeApproval(this)" 
                            data-id="' . $model->id . '" 
                            value="' . $model->is_approved . '"
                            type="checkbox"' . ($model->is_approved ? ' checked' : '') . '>';
            }],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Pic $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>


</div>

<script>
    function changeApproval(e) {
        let id = $(e).data('id');
        let approval = $(e).prop('checked');
        console.log($(e).prop('checked'));
        console.log(id);
        $.get('/admin/pic/update-approval', {
            'pic_id': id,
            'approval': approval
        }, function (data) {
            if (data === 'OK') {
                alert('Обновлено успешно!');
            } else {
                alert('При обновлении возникла ошибка!');
            }
        });
    }
</script>
