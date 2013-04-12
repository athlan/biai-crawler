<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stats.
 *
 * @ORM\Entity
 * @ORM\Table(name="facts_stats_pogoda", uniqueConstraints={@ORM\UniqueConstraint(columns={"entry_date"})})
 */
class StatsPogodaEntity extends Util\AbstractEntity
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \DateTime
     * @ORM\Column(type="date", name="entry_date");
     */
    protected $date;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $temp_avg;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $temp_min;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $temp_max;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $humidity_avg;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $humidity_min;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $humidity_max;
    
    /**
     * @var float
     * @ORM\Column(type="float");
     */
    protected $precipitations;
    
    /**
     * @var float
     * @ORM\Column(type="float");
     */
    protected $pressure;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $wind_speed;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $wind_speed_max;
    
    /**
     * @var float
     * @ORM\Column(type="float");
     */
    protected $visibility;
    
    /**
     * @var string
     * @ORM\Column(type="string");
     */
    protected $events;
    
    public function __construct() {
        
    }
    
    public function populate(array $data) {
        if(isset($data['date']))
            $this->setDate($data['date']);
        
        if(isset($data['temp_avg']))
            $this->setTempAvg($data['temp_avg']);
        
        if(isset($data['temp_min']))
            $this->setTempMin($data['temp_min']);
        
        if(isset($data['temp_max']))
            $this->setTempMax($data['temp_max']);
        
        if(isset($data['humidity_avg']))
            $this->setHumidityAvg($data['humidity_avg']);
        
        if(isset($data['humidity_min']))
            $this->setHumidityMin($data['humidity_min']);
        
        if(isset($data['humidity_max']))
            $this->setHumidityMax($data['humidity_max']);
        
        if(isset($data['precipitations']))
            $this->setPrecipitations($data['precipitations']);
        
        if(isset($data['pressure']))
            $this->setPressure($data['pressure']);
        
        if(isset($data['wind_speed']))
            $this->setWindSpeed($data['wind_speed']);
        
        if(isset($data['wind_speed_max']))
            $this->setWindSpeedMax($data['wind_speed_max']);
        
        if(isset($data['visibility']))
            $this->setVisibility($data['visibility']);
        
        if(isset($data['events']))
            $this->setEvents($data['events']);
    }
    
    /**
     * @return the $id
     */
    public function getId()
    {
        return $this->id;
    }
    
	/**
     * @return the $date
     */
    public function getDate()
    {
        return $this->date;
    }
    
	/**
     * @param DateTime $date
     */
    public function setDate($date)
    {
        if(!$date instanceof \DateTime)
            $date = new \DateTime($date);
        
        $this->date = $date;
    }
	/**
     * @return the $temp_avg
     */
    public function getTempAvg()
    {
        return $this->temp_avg;
    }

	/**
     * @param number $temp_avg
     */
    public function setTempAvg($tempAvg)
    {
        $this->temp_avg = $tempAvg;
    }

	/**
     * @return the $temp_min
     */
    public function getTempMin()
    {
        return $this->temp_min;
    }

	/**
     * @param number $temp_min
     */
    public function setTempMin($tempMin)
    {
        $this->temp_min = $tempMin;
    }

	/**
     * @return the $temp_max
     */
    public function getTempMax()
    {
        return $this->temp_max;
    }

	/**
     * @param number $temp_max
     */
    public function setTempMax($tempMax)
    {
        $this->temp_max = $tempMax;
    }

	/**
     * @return the $humidity_avg
     */
    public function getHumidityAvg()
    {
        return $this->humidity_avg;
    }

	/**
     * @param number $humidity_avg
     */
    public function setHumidityAvg($humidityAvg)
    {
        $this->humidity_avg = $humidityAvg;
    }

	/**
     * @return the $humidity_min
     */
    public function getHumidity_min()
    {
        return $this->humidity_min;
    }

	/**
     * @param number $humidity_min
     */
    public function setHumidityMin($humidityMin)
    {
        $this->humidity_min = $humidityMin;
    }

	/**
     * @return the $humidity_max
     */
    public function getHumidityMax()
    {
        return $this->humidity_max;
    }

	/**
     * @param number $humidity_max
     */
    public function setHumidityMax($humidityMax)
    {
        $this->humidity_max = $humidityMax;
    }

	/**
     * @return the $precipitations
     */
    public function getPrecipitations()
    {
        return $this->precipitations;
    }

	/**
     * @param number $precipitations
     */
    public function setPrecipitations($precipitations)
    {
        $this->precipitations = $precipitations;
    }

	/**
     * @return the $pressure
     */
    public function getPressure()
    {
        return $this->pressure;
    }

	/**
     * @param number $pressure
     */
    public function setPressure($pressure)
    {
        $this->pressure = $pressure;
    }

	/**
     * @return the $wind_speed
     */
    public function getWindSpeed()
    {
        return $this->wind_speed;
    }

	/**
     * @param number $wind_speed
     */
    public function setWindSpeed($windSpeed)
    {
        $this->wind_speed = $windSpeed;
    }

	/**
     * @return the $wind_speed_max
     */
    public function getWindSpeedMax()
    {
        return $this->wind_speed_max;
    }

	/**
     * @param number $wind_speed_max
     */
    public function setWindSpeedMax($windSpeedMax)
    {
        $this->wind_speed_max = $windSpeedMax;
    }

	/**
     * @return the $visibility
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

	/**
     * @param number $visibility
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;
    }

	/**
     * @return the $events
     */
    public function getEvents()
    {
        return explode(',', $this->events);
    }
    
	/**
     * @param string $events
     */
    public function setEvents(array $events)
    {
        $this->events = implode(',', $events);
    }


}
