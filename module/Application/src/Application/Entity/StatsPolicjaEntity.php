<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stats.
 *
 * @ORM\Entity
 * @ORM\Table(name="facts_stats_policja")
 */
class StatsPolicjaEntity extends Util\AbstractEntity
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
    protected $extortions = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $thefts = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $thefts_bulglary = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $road_accidents = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $road_killed = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $road_wounded = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $road_drunk_drivers = 0;
    
    /**
     * @var int
     * @ORM\Column(type="integer");
     */
    protected $road_collisions = 0;
    
    public function __construct() {
        
    }
    
    public function populate(array $data) {
        if(isset($data['date']))
            $this->setDate($data['date']);
        
        if(isset($data['extortions']))
            $this->setExtortions($data['extortions']);
        
        if(isset($data['thefts']))
            $this->setThefts($data['thefts']);
        
        if(isset($data['thefts_bulglary']))
            $this->setTheftsBulglary($data['thefts_bulglary']);
        
        if(isset($data['road_accidents']))
            $this->setRoadAccidents($data['road_accidents']);
        
        if(isset($data['road_killed']))
            $this->setRoadKilled($data['road_killed']);
        
        if(isset($data['road_wounded']))
            $this->setRoadWounded($data['road_wounded']);
        
        if(isset($data['road_drunk_drivers']))
            $this->setRoadDrunkDrivers($data['road_drunk_drivers']);
        
        if(isset($data['road_collisions']))
            $this->setRoadCollisions($data['road_collisions']);
        
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
     * @return the $exortions
     */
    public function getExtortions()
    {
        return $this->extortions;
    }

	/**
     * @param number $exortions
     */
    public function setExtortions($extortions)
    {
        $this->extortions = $extortions;
    }

	/**
     * @return the $thefts
     */
    public function getThefts()
    {
        return $this->thefts;
    }

	/**
     * @param number $thefts
     */
    public function setThefts($thefts)
    {
        $this->thefts = $thefts;
    }

	/**
     * @return the $thefts_bulglary
     */
    public function getTheftsBulglary()
    {
        return $this->thefts_bulglary;
    }

	/**
     * @param number $thefts_bulglary
     */
    public function setTheftsBulglary($theftsBulglary)
    {
        $this->thefts_bulglary = $theftsBulglary;
    }

	/**
     * @return the $road_accidents
     */
    public function getRoadAccidents()
    {
        return $this->road_accidents;
    }

	/**
     * @param number $road_accidents
     */
    public function setRoadAccidents($roadAccidents)
    {
        $this->road_accidents = $roadAccidents;
    }

	/**
     * @return the $road_killed
     */
    public function getRoadKilled()
    {
        return $this->road_killed;
    }

	/**
     * @param number $road_killed
     */
    public function setRoadKilled($roadKilled)
    {
        $this->road_killed = $roadKilled;
    }

	/**
     * @return the $road_wounded
     */
    public function getRoadWounded()
    {
        return $this->road_wounded;
    }

	/**
     * @param number $road_wounded
     */
    public function setRoadWounded($roadWounded)
    {
        $this->road_wounded = $roadWounded;
    }

	/**
     * @return the $road_drunk_drivers
     */
    public function getRoadDrunkDrivers()
    {
        return $this->road_drunk_drivers;
    }

	/**
     * @param number $road_drunk_drivers
     */
    public function setRoadDrunkDrivers($roadDrunkDrivers)
    {
        $this->road_drunk_drivers = $roadDrunkDrivers;
    }

	/**
     * @return the $road_collisions
     */
    public function getRoadCollisions()
    {
        return $this->road_collisions;
    }

	/**
     * @param number $roadCollisions
     */
    public function setRoadCollisions($roadCollisions)
    {
        $this->road_collisions = $roadCollisions;
    }
}
