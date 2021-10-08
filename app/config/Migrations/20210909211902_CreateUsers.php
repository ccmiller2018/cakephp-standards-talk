<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        
        $table->addColumn(
            'email',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'password',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'created',
            'datetime',
            [
                'default' => null,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'modified',
            'datetime',
            [
                'default' => null,
                'null' => false,
            ]
        );
        
        $table->create();
    }
}
