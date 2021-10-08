<?php

use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;

/** @var \Cake\Routing\RouteBuilder $routes */
$routes->setRouteClass(DashedRoute::class);

$routes->scope(
    '/',
    function (RouteBuilder $routes): void {
        $routes->get(
            '/',
            [
                'controller' => 'HomePage',
                'action' => 'view',
            ],
            'Home'
        );

        $routes->get(
            'articles/{articleId}',
            [
                'controller' => 'ArticleEdit',
                'action' => 'view',
            ],
            'Article.Edit'
        )
            ->setPatterns(
                [
                    'articleId' => '[0-9]+',
                ]
            )
            ->setPass(
                [
                    'articleId',
                ]
            );
            
        $routes->put(
            'articles/{articleId}',
            [
                'controller' => 'ArticleSave',
                'action' => 'save',
            ],
            'Article.Save',
        )
            ->setPatterns(
                [
                    'articleId' => '[0-9]+',
                ]
            )
            ->setPass(
                [
                    'articleId',
                ]
            );

        $routes->get(
            'articles/{slug}',
            [
                'controller' => 'ArticleView',
                'action' => 'view',
            ],
            'Article.View'
        )
            ->setPatterns(
                [
                    'slug' => '[a-zA-Z0-9\-]+',
                ]
            )
            ->setPass(
                [
                    'slug',
                ]
            );
        
        $routes->get(
            'articles/create',
            [
                'controller' => 'ArticleCreate',
                'action' => 'create',
            ],
            'Article.Create',
        );

        $routes->post(
            'articles/create',
            [
                'controller' => 'ArticleSaveNew',
                'action' => 'save',
            ],
            'Article.SaveNew',
        );

        $routes->get(
            'dashboard',
            [
                'controller' => 'Dashboard',
                'action' => 'view',
            ],
            'Dashboard'
        );
        
        $routes->connect(
            'login',
            [
                'controller' => 'Login',
                'action' => 'login',
            ],
            [
                '_name' => 'Authentication.Login',
            ]
        );
    }
);
