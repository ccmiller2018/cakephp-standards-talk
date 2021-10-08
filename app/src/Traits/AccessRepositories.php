<?php

namespace App\Traits;

use App\Model\Table\ArticlesTable;
use App\Model\Table\UsersTable;
use Cake\Datasource\ModelAwareTrait;
use Cake\Datasource\RepositoryInterface;

/**
 * @property UsersTable $Users
 * @property ArticlesTable $Articles
 */
trait AccessRepositories
{
    use ModelAwareTrait;

    public function usersRepository(): UsersTable|RepositoryInterface
    {
        if (!isset($this->Users) || !$this->Users instanceof RepositoryInterface) {
            $this->loadModel('Users');
        }

        return $this->Users;
    }

    public function articlesRepository(): ArticlesTable|RepositoryInterface
    {
        if (!isset($this->Articles) || !$this->Articles instanceof RepositoryInterface) {
            $this->loadModel('Articles');
        }

        return $this->Articles;
    }
}
