<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateArticles extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('articles');

        $table->addColumn(
            'user_id',
            'integer',
            [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'title',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'slug',
            'string',
            [
                'default' => null,
                'limit' => 255,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'body',
            'text',
            [
                'default' => null,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'published',
            'boolean',
            [
                'default' => null,
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