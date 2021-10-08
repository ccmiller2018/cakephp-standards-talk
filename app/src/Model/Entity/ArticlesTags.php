<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ArticlesTag Entity
 *
 * @property int $id
 * @property int $article_id
 * @property int $tag_id
 *
 * @property \App\Model\Entity\Article $article
 * @property \App\Model\Entity\Tag $tag
 */
class ArticlesTags extends Entity
{
    protected $_accessible = [
        'article_id' => true,
        'tag_id' => true,
        'article' => true,
        'tag' => true,
    ];
}
