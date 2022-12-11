<?php

/** @var yii\web\View $this */
/** @var string|bool $image */

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
                    <button type="button" class="btn btn-outline-danger mx-2">Отклонить</button>
                    <button type="button" class="btn btn-outline-success mx-2">Одобрить</button>
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
