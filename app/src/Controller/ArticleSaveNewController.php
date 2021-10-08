<?php

namespace App\Controller;

use App\Model\Entity\Article;
use App\Traits\AccessRepositories;
use Cake\Http\Response;
use Cake\Routing\Router;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class ArticleSaveNewController extends AppController
{
    use AccessRepositories;

    public function save(): Response
    {
        $article = new Article($this->request->getData());
        $article->user_id = $this->Authentication->getIdentityData('id');
        $article->published = true;
        
        $save = $this->articlesRepository()->save($article);

        if (!$save instanceof Article) {
            $this->Flash->error('Failed to save Article');
            return $this->redirect(
                Router::url(
                    [
                        '_name' => 'Article.Create',
                    ]
                )
            );
        }
        
        $this->Flash->success('Successfully saved article');
        return $this->redirect(
            Router::url(
                [
                    '_name' => 'Dashboard',
                ]
            )
        );
    }
}
