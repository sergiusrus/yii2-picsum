<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h4 class="display-4">The random pictures.</h4>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="my-3">
                <img src="https://picsum.photos/id/<?= random_int(1, 1000) ?>/600/500"
                     alt="Random Image"
                     class="rounded mx-auto d-block">
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-outline-danger mx-2">Отклонить</button>
                <button type="button" class="btn btn-outline-success mx-2">Одобрить</button>
            </div>

        
        
        </div>

    </div>
</div>
