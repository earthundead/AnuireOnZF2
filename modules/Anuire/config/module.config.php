<?php

namespace Anuire;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [
        'invokables' => [
            'Anuire\Controller\Index' => 'Anuire\Controller\IndexController',
        ],
    ],
    
    'router' => [
        'routes' => [
			'default' => [
                'type'    => 'Literal',
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/',
                    'defaults' => [
                        'controller'    => 'Anuire\Controller\Index',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
            'anuire' => [
                'type'    => 'Literal',
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/anuire',
                    'defaults' => [
                        'controller'    => 'Anuire\Controller\Index',
                        'action'        => 'viewtable',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
					'test' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/test',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'viewtest',
							],
						],
                    ],
                    'recreatedb' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/recreatedb',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'recreatedb',
							],
						],
                    ],
                    'logfile' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/logfile',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'viewlogfile',
							],
						],
                    ],
                    'image' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/image',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'viewimage',
							],
						],
                    ],
                    'table' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/table',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'viewtable',
							],
						],
                    ],
                    'form' => [
						'type'    => 'Literal',
						'options' => [
							'route'    => '/form',
							'defaults' => [
								'controller'    => 'Anuire\Controller\Index',
								'action'        => 'viewform',
							],
						],
                    ],
                ],
            ],
        ],
    ],
    
    'console' => [
        'router' => [
            'routes' => [
                'defaultConsole' => [
                    'options' => [
                        'route'    => ' ',
                        'defaults' => [
                            'controller' => 'Anuire\Controller\Index',
                            'action'     => 'index',
                        ],
                    ],
                ],
            ],
        ],
    ],
    
    'view_manager' => 
    [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'notFoundTemplate'         => 'error/404',
        'exceptionTemplate'        => 'error/index',
        'layoutTemplate' 		   => 'site/layout',
		'template_map' => 
		[
			//'' => __DIR__ .  '/../views/anuire/index/index.phtml',
            'anuire/index/index'    => __DIR__ . '/../views/anuire/index/index.phtml',
            'anuire/index/viewtest' => __DIR__ . '/../views/anuire/index/viewtest.phtml',
            'site/layout'           => __DIR__ . '/../views/anuire/index/index.phtml',
            'error/index'           => __DIR__ . '/../views/anuire/index/index.phtml',
            'error/404'             => __DIR__ . '/../views/anuire/index/index.phtml',
        ],
        'template_path_stack' => 
        [
            'anuire' => __DIR__ . '/../views',
        ],
    ],
    /*'log' => 
    [
        'Log\App' => [
            'writers' => 
            [                
                    'name' => 'stream',
                    'priority' => 1000,
                    'options' => [
                        'stream' => __DIR__ . '/../data/logfile.log',
                    ],
            ],
        ],
    ], */  
];

