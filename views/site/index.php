<?php

use yii\helpers\Html;

/** @var yii\web\View $this */



$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5 shadow-lg p-3 rounded">
        <h1 class="display-4">Сам не мойся!</h1>

        <p class="lead">Помоем за вас</p>

        <!-- <p><a class= href="https://www.yiiframework.com">Личный кабинет</a></p> -->
        <?= Html::a("Личный кабинет", ["application/index"],['class'=>"btn btn-lg btn-success"]) ?>
    </div>

    <div class="body-content">

    

    </div>
</div>