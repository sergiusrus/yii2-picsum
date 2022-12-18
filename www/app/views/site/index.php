<?php

/** @var yii\web\View $this */
/** @var string|bool $image */
/** @var integer $image_id */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h4 class="display-4">The random pictures.</h4>
    </div>

    <div class="body-content">
        <div class="row">
            <?php if ($image): ?>
                <div class="my-3">
                    <img src="<?= $image ?>"
                         alt="Random Image"
                         class="rounded mx-auto d-block">
                </div>
                <div class="text-center">
                    <?= Html::a('Отклонить',
                        Url::to(['site/index']), [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'image-id' => $image_id,
                                    'approval' => 0,
                                ],
                                'class' => 'btn btn-outline-danger mx-2'
                        ])
                    ?>
                    <?= Html::a('Одобрить',
                        Url::to(['site/index']), [
                                'data-method' => 'POST',
                                'data-params' => [
                                    'image-id' => $image_id,
                                    'approval' => 1,
                                ],
                                'class' => 'btn btn-outline-success mx-2'
                        ])
                    ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info my-3" role="alert">
                    Изображение не найдено!
                    Пожалуйста, перезагруте страницу.
                </div>
                <div class="text-center">
                    <a href="/" class="btn btn-outline-info">Перегрузить</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
