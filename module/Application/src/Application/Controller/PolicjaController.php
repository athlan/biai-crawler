<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * 
 * @author Athlan
 *
 */
class PolicjaController extends Util\BaseCliController
{
    public function indexAction()
    {
        $model = $this->getModelRemotePolicja();
        $modelEntity = $this->getModelEntityPolicja();
        
        $nocache = $this->params()->fromRoute('nocache', false);
        
        $dateFrom = $this->params()->fromRoute('dateFrom');
        if(null === $dateFrom)
            $dateFrom = '2 weeks ago';
        $dateFrom = new \DateTime('@' . strtotime($dateFrom));
        
        $dateTo = $this->params()->fromRoute('dateTo');
        if(null === $dateTo)
            $dateTo = 'now';
        $dateTo = new \DateTime('@' . strtotime($dateTo));
        
        $this->_printLine("Grabbing data from policja.pl");
        $this->_printLine("Date from " . $dateFrom->format("Y-m-d") . " to " . $dateTo->format("Y-m-d") . "");
        
        $diff = $dateFrom->diff($dateTo);
        
        $i = 0;
        while($i <= $diff->d) {
            $date = $dateFrom->format('Y-m-d');
            
            $this->_printLine();
            $this->_printLine("Getting " . $date . "...");
            
            $entity = $model->getStatsForDate($dateFrom, !$nocache);
            
            $this->_printLine(round($i / $diff->d * 100, 2) . '% completed.');
            $this->_printLine("");
            
            $dateFrom->modify('+1 day');
            ++$i;
            
            if(null !== $entity)
                $modelEntity->save($entity);
        }
        
        exit;
        
        return "hello";
    }
    
    /**
     * @return \Application\Model\RemotePolicjaModel
     */
    public function getModelRemotePolicja()
    {
        return $this->getServiceLocator()->get('Model\RemotePolicja');
    }
    
    /**
     * @return \Application\Model\EntityPolicjaModel
     */
    public function getModelEntityPolicja()
    {
        return $this->getServiceLocator()->get('Model\EntityPolicja');
    } 
}
