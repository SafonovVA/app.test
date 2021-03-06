<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var app\models\Article $articles */
/** @var app\controllers\SiteController $pagination */
/** @var app\controllers\SiteController $popular */
/** @var app\controllers\SiteController $recent */
/** @var app\controllers\SiteController $categories */

$js = <<<JS
$(document).ready(function(){
    $('.modal').modal();
  });
JS;

$this->registerJS($js);
?>
<div class="row">
    <div class="col-md-8">

        <?php foreach ($articles as $article): ?>
            <article class="post">
                <div class="post-thumb">
                    <a href="<?= Url::toRoute(['site/view' , 'id' => $article->id]) ?>"><img src="<?= $article->getImage() ?>" alt=""></a>

                    <a href="<?= Url::toRoute(['site/view' , 'id' => $article->id]) ?>" class="post-thumb-overlay text-center">
                        <div class="text-uppercase text-center">View Post</div>
                    </a>
                </div>
                <div class="post-content">
                    <header class="entry-header text-center text-uppercase">
                        <h6><a href="<?= Url::toRoute(['site/category' , 'id' => $article->category->id]) ?>">
                                <?= $article->category->title; ?>
                            </a></h6>

                        <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view' , 'id' => $article->id]) ?>"><?= $article->title ?></a></h1>


                    </header>
                    <div class="entry-content">
                        <p><?= $article->description; ?></p>

                        <div class="btn-continue-reading text-center text-uppercase">
                            <a href="<?= Url::toRoute(['site/view' , 'id' => $article->id]) ?>" class="more-link">Continue Reading</a>
                        </div>
                    </div>
                    <div class="social-share">
                        <span class="social-share-title pull-left text-capitalize">By <a href="#">Rubel</a> On <?= $article->getDate() ?></span>
                        <ul class="text-center pull-right">
                            <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $article->viewed ?>
                        </ul>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>

        <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
        ?>
    </div>
    <?= $this->render('/partials/sidebar', [
        'popular' => $popular,
        'recent' => $recent,
        'categories' => $categories,
    ]);
    ?>

</div>


<!-- Modal Trigger -->
<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>

<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Modal Header</h4>
        <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
</div>
