<?php

declare(strict_types=1);

namespace App\Controller;

use Authentication\Authenticator\ResultInterface;
use Cake\Event\EventInterface;
use Cake\Http\Response;

/**
 * @property \Authentication\Controller\Component\AuthenticationComponent $Authentication
 */
class LoginController extends AppController
{
    public function beforeFilter(EventInterface $event): void
    {
        parent::beforeFilter($event);
        
        $this->Authentication->addUnauthenticatedActions(
            [
                'login',
            ]
        );
    }

    public function login(): Response|null
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();

        if ($result instanceof ResultInterface && $result->isValid()) {
            return $this->redirect(
                [
                    '_name' => 'Dashboard',
                ]
            );
        }
    
        if (
            $this->request->is('post')
            && $result instanceof ResultInterface
            && !$result->isValid()
        ) {
            $this->Flash->error(__('Invalid username or password'));
            return $this->redirect(
                [
                    '_name' => 'Authentication.Login',
                ]
            );
        }

        return $this->render();
    }
}
