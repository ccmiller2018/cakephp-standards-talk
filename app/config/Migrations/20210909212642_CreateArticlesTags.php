<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateArticlesTags extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('articles_tags');
        
        $table->addColumn(
            'article_id',
            'integer',
            [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]
        );
        
        $table->addColumn(
            'tag_id',
            'integer',
            [
                'default' => null,
                'limit' => 11,
                'null' => false,
            ]
        );
        
        $table->create();
    }
}
