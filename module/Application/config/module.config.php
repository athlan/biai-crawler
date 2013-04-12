<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

return array(
    'console' => array(
        'router' => array(
            'routes' => require __DIR__ . '/router.config.php',
        )
    ),
    
    'controllers' => array(
        'invokables' => array(
            'Controller\Index' => 'Application\Controller\IndexController',
            'Controller\Policja' => 'Application\Controller\PolicjaController',
        ),
    ),
    
    'service_manager' => array(
        'invokables' => array(
            'Model\EntityPolicja' => 'Application\Model\EntityPolicjaModel',
            'Model\RemotePolicja' => 'Application\Model\RemotePolicjaModel',
        ),
        
        'factories' => array(
            'cacheContainer' => function () {
                return \Zend\Cache\StorageFactory::factory(array(
                    'adapter' => array(
                        'name' => 'filesystem',
                        'options' => array(
                            'cache_dir' => __DIR__ . '/../../../data/cache',
                            'ttl' => 100
                        ),
                    ),
                    'plugins' => array(
                        array(
                            'name' => 'serializer',
                            'options' => array(
                
                            )
                        )
                    )
                ));
            },
        ),
    ),
    
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    ),
    
);
