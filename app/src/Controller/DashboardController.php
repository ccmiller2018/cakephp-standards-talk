<?php

namespace App\Controller;

use App\Traits\AccessRepositories;
use Cake\Http\Response;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class DashboardController extends AppController
{
    use AccessRepositories;

    public function view(): Response
    {
        $articles = $this->articlesRepository()->getAllByUserId($this->Authentication->getIdentityData('id'));

        $this->set(compact(['articles']));
        return $this->render();
    }
}
