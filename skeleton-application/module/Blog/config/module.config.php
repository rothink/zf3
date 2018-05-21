<?php
/**
 * Created by PhpStorm.
 * User: rothink
 * Date: 20/05/18
 * Time: 21:14
 */

namespace Blog;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'factories' => [
//            Controller\BlogController::class => InvokableFactory::class
        ]
    ],

    'router' => [
        'routes' => [
            'blog'  => [
                'type' => 'literal',
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action' => 'index'
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_path_stack' => [
            'blog' => __DIR__ . "/../view"
        ]
    ],
];