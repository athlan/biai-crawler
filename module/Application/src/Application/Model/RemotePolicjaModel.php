<?php

namespace Application\Model;

use Application\Entity\StatsPolicjaEntity;

class RemotePolicjaModel extends Util\AbstractWebContentGrabberModel
{
    /**
     * 
     * @param \DateTime $date
     * @param bool $cache
     * @return NULL|\Application\Entity\StatsPolicjaEntity
     */
    public function getStatsForDate(\DateTime $date, $cache = true) {
        // e.x. http://www.slaska.policja.gov.pl/staystyka-zdarzen/go:data:2013_04_02/
        
        $url = 'http://www.slaska.policja.gov.pl/staystyka-zdarzen/go:data:%s/';
        
        $url = sprintf($url, $date->format("Y_m_d"));
        
        $contents = $this->performRequest($url, $cache);
        
        if(null === $contents)
            return null;
        
        $result = $this->parse($date, $contents);
        
        if(null === $result)
            return null;
        
        $entity = new StatsPolicjaEntity();
        $entity->populate($result);
        
        return $entity;
    }
    
    /**
     * 
     * @param \DateTime $date
     * @param unknown_type $contents
     * @return null|array
     */
    private function parse(\DateTime $date, $contents) {
        $result = [
            'date' => null,
            'extortions' => 0,
            'thefts' => 0,
            'thefts_bulglary' => 0,
            'road_accidents' => 0,
            'road_killed' => 0,
            'road_wounded' => 0,
            'road_drunk_drivers' => 0,
            'road_collisions' => 0,
        ];
        
        preg_match('#<span class="sData2">(.*?)</span>#', $contents, $matches);
        
        if(!isset($matches[1]))
            return null;
        
        $parsedDate = new \DateTime($matches[1]);
        
        if($parsedDate->diff($date)->d)
            return null;
        
        $result['date'] = $parsedDate;
        
        preg_match_all('#<div class="sRow"(.*?)>(.*?)</div>#is', $contents, $matches);
        
        foreach ($matches[2] as $row) {
            preg_match('#(.*?)<span class="sIlosc"(.*?)>([0-9]+)</span>#', $row, $rowMatch);
            
            if(isset($rowMatch[1]) && isset($rowMatch[3])) {
                $name = trim(strip_tags($rowMatch[1]));
                $value = (int) $rowMatch[3];
                
                switch($name) {
                    case "przestępstwa rozbójnicze" : 
                        $result['extortions'] = $value; break;
                        
                    case "kradzieże z włamaniem" :
                        $result['thefts_bulglary'] = $value; break;
                        
                    case "kradzieże" :
                        $result['thefts'] = $value; break;
                    
                    case "wypadki" :
                        $result['road_accidents'] = $value; break;
                    
                    case "zabici" :
                        $result['road_killed'] = $value; break;
                    
                    case "ranni" :
                        $result['road_wounded'] = $value; break;
                    
                    case "nietrzeźwi kierowcy" :
                        $result['road_drunk_drivers'] = $value; break;
                    
                    case "kolizje" :
                        $result['road_collisions'] = $value; break;
                }
            }
        }
        
        return $result;
    }
}
