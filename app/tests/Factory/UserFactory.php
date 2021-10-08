<?php

declare(strict_types=1);

namespace App\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory as CakephpBaseFactory;
use Carbon\Carbon;
use Faker\Generator;

/**
 * UserFactory
 *
 * @method \App\Model\Entity\User getEntity()
 * @method \App\Model\Entity\User[] getEntities()
 * @method \App\Model\Entity\User|\App\Model\Entity\User[] persist()
 * @static \App\Model\Entity\User get(mixed $primaryKey, array $options)
 */
class UserFactory extends CakephpBaseFactory
{
    protected function getRootTableRegistryName(): string
    {
        return 'Users';
    }

    protected function setDefaultTemplate(): void
    {
        $this->setDefaultData(
            function (Generator $faker): array {
                return [
                    'email' => $faker->email(),
                    'password' => 'password',
                    'created' => Carbon::now(),
                    'modified' => Carbon::now(),
                ];
            }
        );
    }
}
