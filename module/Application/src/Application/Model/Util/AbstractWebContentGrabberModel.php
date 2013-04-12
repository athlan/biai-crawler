<?php
namespace Application\Model\Util;

class AbstractWebContentGrabberModel implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{
    use \Application\Util\CliOutput;
    use \Application\Util\ServiceLocatorInterfaceImpl;
    
    public function createCache() {
        return $this->getServiceLocator()->get('cacheContainer');
    }
    
    public function performRequest($url, $cacheEnabled = true) {
        
        $cache = $this->createCache();
        $cacheKey = md5("url/" . $url);
        
        if($cacheEnabled) {
            $this->_printLine('Loading from cache ' . $cacheKey . ' ' . $url);
            
            if($cache->hasItem($cacheKey)) {
                return $cache->getItem($cacheKey);
            }
        }
        
        $ch = $this->createHandler($url);
        
        $this->_printLine('Connecting to ' . $url . ' ...');
        
        $contents = \curl_exec($ch);
        $info = curl_getinfo($ch);
        
        \curl_close($ch);
        
        if($info['http_code'] != 200) {
            $this->_printLine('Invalid response code: ' . $info['http_code']);
            return null;
        }
        
        $this->_printLine('Request response: ' . $info['http_code']);
        $this->_printLine('Proceed in ' . $info['total_time'] . 's');
        
        $cache->setItem($cacheKey, $contents);
        $this->_printLine('Saving cache as ' . $cacheKey);
        
        return $contents;
    }
    
    public function createHandler($url, $cache = true) {
        
        $ch = \curl_init();
        
        \curl_setopt($ch, CURLOPT_URL, $url);
        \curl_setopt($ch, CURLOPT_HEADER, 0);
        \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        return $ch;
    }
}
