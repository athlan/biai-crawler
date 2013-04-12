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
    
    public function __construct() {
        
    }
    
    public function populate(array $data) {
        if(isset($data['date']))
            $this->setDate($data['date']);
        
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

}
