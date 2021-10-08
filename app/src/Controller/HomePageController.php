<?php

namespace App\Controller;

use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class HomePageController extends AppController
{
    public $paginate = [
        'Articles' => [
            'conditions' => [
                'published' => 1,
            ],
            'contain' => [
                'Tags',
            ],
            'limit' => 100,
        ],
    ];

    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        
        $this->Authentication->addUnauthenticatedActions(['view']);
    }

    public function view(): Response
    {
        $this->set('articles', $this->paginate('Articles'));
        return $this->render();
    }
}
