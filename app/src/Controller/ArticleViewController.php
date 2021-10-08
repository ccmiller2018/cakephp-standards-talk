<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Traits\AccessRepositories;
use Cake\Event\EventInterface;
use Cake\Http\Response;
use Cake\Routing\Router;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class ArticleViewController extends AppController
{
    use AccessRepositories;

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        
        $this->Authentication->addUnauthenticatedActions(['view']);
    }

    public function view(string $slug): Response
    {
        $article = $this->articlesRepository()->getBySlug($slug);

        if (!$article instanceof Article) {
            $this->Flash->error('Could not find the article to show.');
            return $this->redirect(
                Router::url(
                    [
                        '_name' => 'Home',
                    ]
                )
            );
        }

        $this->set(
            compact(
                [
                    'article',
                ]
            )
        );
        return $this->render();
    }
}
