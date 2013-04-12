<?php

namespace Application\Model;

use Application\Entity\StatsPogodaEntity;

class RemotePogodaModel extends Util\AbstractWebContentGrabberModel
{
    /**
     * 
     * @param \DateTime $date
     * @param bool $cache
     * @return NULL|\Application\Entity\StatsPolicjaEntity
     */
    public function getStatsForDate($city, \DateTime $date, $cache = true) {
        // e.x. http://www.wunderground.com/history/airport/EPKT/2013/4/12/DailyHistory.html?req_city=gliwice
        
        $url = 'http://www.wunderground.com/history/airport/EPKT/%s/DailyHistory.html?req_city=%s';
        
        $url = sprintf($url, $date->format("Y/m/d"), $city);
        
        $contents = $this->performRequest($url, $cache);
        
        if(null === $contents)
            return null;
        
        $result = $this->parse($date, $contents);
        
        if(null === $result)
            return null;
        
        $entity = new StatsPogodaEntity();
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
            'temp_avg' => 0,
            'temp_min' => 0,
            'temp_max' => 0,
            
            'humidity_avg' => 0,
            'humidity_min' => 0,
            'humidity_max' => 0,
            
            'precipitations' => 0,
            'pressure' => 0,
            
            'wind_speed' => 0,
            'wind_speed_max' => 0,
            'visibility' => 0,
            'events' => [],
        ];
        
        preg_match('#<table(.*?)id="historyTable">(.*?)</table>#s', $contents, $matches);
        
        preg_match_all('#<tr>(.*?)</tr>#is', $matches[2], $matchesTr);
        
        foreach ($matchesTr[1] as $row) {
            preg_match_all('#<td(.*?)>(.*?)</td>#s', $row, $rowMatch);
            $rowMatch = $rowMatch[2];
            
            if(!isset($rowMatch[0]) || !isset($rowMatch[1]))
                continue;
            
            $name = trim(strip_tags($rowMatch[0]));
            $value = null;
            
            preg_match('#<span class="b">(.*?)</span>#', $rowMatch[1], $rowMatchValue);
            if(isset($rowMatchValue[1]))
                $value = trim(strip_tags($rowMatchValue[1]));
            else
                $value = trim(strip_tags($rowMatch[1]));
            
            switch ($name) {
                case "Mean Temperature" :
                    $result['temp_avg'] = (int) $value; break;
                
                case "Max Temperature" :
                    $result['temp_min'] = (int) $value; break;
                
                case "Min Temperature" :
                    $result['temp_max'] = (int) $value; break;
                
                case "Average Humidity" :
                    $result['humidity_avg'] = (int) $value; break;
                    
                case "Minimum Humidity" :
                    $result['humidity_min'] = (int) $value; break;
                
                case "Maximum Humidity" :
                    $result['humidity_max'] = (int) $value; break;
                
                case "Precipitation" :
                    $result['precipitations'] = (float) $value; break;
                    
                case "Sea Level Pressure" :
                    $result['pressure'] = (float) $value; break;
                        
                case "Wind Speed" :
                    $result['wind_speed'] = (int) $value; break;
                
                case "Max Wind Speed" :
                    $result['wind_speed_max'] = (int) $value; break;

                case "Visibility" :
                    $result['visibility'] = (float) $value; break;
                
                case "Events" :
                    foreach (explode(',', $value) as $v) {
                        $v = trim($v);
                        
                        if($v) {
                            $result['events'][] = $v;
                        }
                    }
                    
                    break;
            }
        }
        
        return $result;
    }
}
