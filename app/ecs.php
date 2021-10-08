<?php

use SlevomatCodingStandard\Sniffs\Functions\UnusedParameterSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(__DIR__ . '/vendor/jumptwentyfour/php-coding-standards/ecs.php');

    $parameters = $containerConfigurator->parameters();
    
    $parameters->set(
        Option::PATHS,
        [
            __DIR__ . '/src',
            __DIR__ . '/tests',
            __DIR__ . '/config',
        ]
    );

    $parameters->set(
        Option::SKIP,
        [
        UnusedParameterSniff::class => [
            __DIR__ . '/src/Application.php',
        ]
    ]);
};
