<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.3.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Test\TestCase;

use App\Application;
use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\MiddlewareQueue;
use Cake\Routing\Middleware\AssetMiddleware;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;
use InvalidArgumentException;

/**
 * ApplicationTest class
 */
class ApplicationTest extends TestCase
{
    use IntegrationTestTrait;

    /**
     * testBootstrap
     */
    public function testBootstrap(): void
    {
        $app = new Application(dirname(dirname(__DIR__)) . '/config');
        $app->bootstrap();
        
        $plugins = $app->getPlugins();

        self::assertCount(5, $plugins);

        self::assertSame('Bake', $plugins->get('Bake')->getName());
        self::assertSame('DebugKit', $plugins->get('DebugKit')->getName());
        self::assertSame('Migrations', $plugins->get('Migrations')->getName());
        self::assertSame('IdeHelper', $plugins->get('IdeHelper')->getName());
        self::assertSame('CakephpFixtureFactories', $plugins->get('CakephpFixtureFactories')->getName());
    }

    /**
     * testBootstrapPluginWitoutHalt
     */
    public function testBootstrapPluginWithoutHalt(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $app = $this->getMockBuilder(Application::class)
            ->setConstructorArgs([dirname(dirname(__DIR__)) . '/config'])
            ->onlyMethods(['addPlugin'])
            ->getMock();

        $app->method('addPlugin')
            ->will(self::throwException(new InvalidArgumentException('test exception.')));

        $app->bootstrap();
    }

    /**
     * testMiddleware
     */
    public function testMiddleware(): void
    {
        $app = new Application(dirname(dirname(__DIR__)) . '/config');
        $middleware = new MiddlewareQueue();

        $middleware = $app->middleware($middleware);

        self::assertInstanceOf(ErrorHandlerMiddleware::class, $middleware->current());
        
        $middleware->seek(1);
        self::assertInstanceOf(AssetMiddleware::class, $middleware->current());
        
        $middleware->seek(2);
        self::assertInstanceOf(RoutingMiddleware::class, $middleware->current());
    }
}
