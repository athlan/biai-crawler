<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace ApplicationCli;

return array(
    'say-hello' => array(
        'options' => array(
            'route'    => 'hello',
            'defaults' => array(
                'controller' => 'Controller\Index',
                'action'     => 'index'
            ),
        ),
    ),
    
    'grab-policja' => array(
        'options' => array(
            'route'    => 'grab policja [--dateFrom=] [--dateTo=] [--nocache]',
            'defaults' => array(
                'controller' => 'Controller\Policja',
                'action'     => 'index'
            ),
        ),
    ),
    
    'grab-pogoda' => array(
        'options' => array(
            'route'    => 'grab pogoda [--dateFrom=] [--dateTo=] [--nocache] <city>',
            'defaults' => array(
                'controller' => 'Controller\Pogoda',
                'action'     => 'index'
            ),
        ),
    ),
);
