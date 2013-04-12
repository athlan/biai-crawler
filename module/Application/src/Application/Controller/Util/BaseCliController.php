<?php
namespace Application\Controller\Util;

use Zend\Mvc\MvcEvent;

use Application\Acl\AclAccess;

use Zend\Mvc\Controller\AbstractActionController;

/**
 * 
 * @author Athlan
 *
 */
abstract class BaseCliController extends AbstractActionController
{
    public function onDispatch(MvcEvent $e) {
        $request = $this->getRequest();

        // Make sure that we are running in a console and the user has not tricked our
        // application into running this action from a public web server.
        if (!$request instanceof \Zend\Console\Request){
            throw new \RuntimeException('You can only use this action from a console!');
        }
        
        parent::onDispatch($e);
    }
    
    public function getConfig() {
        return $this->getServiceLocator()->get('Config');
    }
    
    use \Application\Util\CliOutput;
}
