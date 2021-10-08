<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Traits\AccessRepositories;
use Cake\Http\Response;
use Cake\Routing\Router;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class ArticleSaveController extends AppController
{
    use AccessRepositories;

    public function save(string $articleId): Response
    {
        $article = $this->articlesRepository()->getById($articleId);

        if (!$article instanceof Article) {
            $this->Flash->error('Could not find the article to update.');
            return $this->redirect(
                Router::url(
                    [
                        '_name' => 'Dashboard',
                    ]
                )
            );
        }

        $article->title = $this->request->getData('title');
        $article->body = $this->request->getData('body');
        $article->slug = $this->request->getData('slug');

        $save = $this->articlesRepository()->save($article);

        if (!$save instanceof Article) {
            $this->Flash->error('Failed to update Article');
            return $this->redirect(
                Router::url(
                    [
                        '_name' => 'Article.Update',
                        $articleId,
                    ]
                )
            );
        }
        
        $this->Flash->success('Successfully updated article');
        return $this->redirect(
            Router::url(
                [
                    '_name' => 'Dashboard',
                ]
            )
        );
    }
}
