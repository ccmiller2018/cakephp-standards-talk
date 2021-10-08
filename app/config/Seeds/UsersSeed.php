<?php

declare(strict_types=1);

use App\Test\Factory\UserFactory;
use Cake\Datasource\ModelAwareTrait;
use Migrations\AbstractSeed;

/**
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersSeed extends AbstractSeed
{
    use ModelAwareTrait;

    public function run()
    {
        $users = UserFactory::make(
            [
                [
                    'email' => 'chris@jump24.co.uk',
                    'password' => 'password',
                ],
            ]
        )
        ->getEntities();

        $this->loadModel('Users');
        
        $this->Users->saveMany($users);
    }
}
