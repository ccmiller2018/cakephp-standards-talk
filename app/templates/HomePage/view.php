<h1>CakeFest 2021 Blog App</h1>

<?php

use Cake\Routing\Router;

echo $this->Html->link('Log In', ['_name' => 'Authentication.Login']);

if ($articles->count() === 0) : ?>
    <h1>No Articles To Display</h1>
<?php else :?>
    <?php foreach ($articles as $article) : ?>
        <h2>
            <?= $this->Html->link($article->title, ['_name' => 'Article.View', $article->slug]) ?>
        </h2>
        <?php foreach ($article->tags as $tag) : ?>
            <p><?=$tag->title; ?></p>
        <?php endforeach; ?>
        <p><?= $article->getShortenedBody(); ?></p>
    <?php endforeach; ?>

    <?= $this->Paginator->numbers(); ?>
<?php endif; ?>
