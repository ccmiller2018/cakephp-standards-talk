<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Faker\Generator;

/**
 * ArticleFactory
 *
 * @method \App\Model\Entity\Article getEntity()
 * @method \App\Model\Entity\Article[] getEntities()
 * @method \App\Model\Entity\Article|\App\Model\Entity\Article[] persist()
 * @static \App\Model\Entity\Article get(mixed $primaryKey, array $options)
 */
class ArticleFactory extends CakephpBaseFactory
{
    protected function getRootTableRegistryName(): string
    {
        return 'Articles';
    }

    protected function setDefaultTemplate(): void
    {
        $this->setDefaultData(
            function (Generator $faker): array {
                $title = $faker->sentence(6);
                
                return [
                    'user_id' => 1,
                    'title' => $title,
                    'slug' => strtolower(str_replace(' ', '-', str_replace('.', '', $title))),
                    'body' => $faker->paragraphs(3, true),
                    'published' => true,
                ];
            }
        );
    }
}
