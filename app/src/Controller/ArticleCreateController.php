<?php

namespace App\Controller;

use Cake\Http\Response;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class ArticleCreateController extends AppController
{
    public function create(): Response
    {
        return $this->render();
    }
}
