<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Traits\AccessRepositories;
use Cake\Http\Response;
use Cake\Routing\Router;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class ArticleEditController extends AppController
{
    use AccessRepositories;

    public function view(string $articleId): Response
    {
        $article = $this->articlesRepository()->getById($articleId);

        if (!$article instanceof Article) {
            $this->Flash->error('Could not find the article to edit.');
            return $this->redirect(
                Router::url(
                    [
                        '_name' => 'Dashboard',
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
