<?php

declare(strict_types=1);

use App\Test\Factory\ArticleFactory;
use App\Traits\AccessRepositories;
use Cake\Datasource\ModelAwareTrait;
use Migrations\AbstractSeed;

/**
 * Articles seed.
 */
class ArticlesSeed extends AbstractSeed
{
    use ModelAwareTrait;
    use AccessRepositories;

    public function run()
    {
        $articles = ArticleFactory::make([], 5)->getEntities();

        $this->loadModel('Articles');
        
        $this->articlesRepository()->saveMany($articles);
    }
}
