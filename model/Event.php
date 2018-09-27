<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 14/08/2018
 * Time: 16:09
 */

class Event
{
    protected $id;
    protected $name;
    protected $datebegin;
    protected $dateend;
    protected $numberplace;
    protected $position;


    public function __construct(array $donnees)
    {
        $this->hydrate($donnees);
    }
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDatebegin()
    {
        return $this->datebegin;
    }

    /**
     * @param mixed $date_begin
     */
    public function setDatebegin($datebegin)
    {
        $this->datebegin = $datebegin;
    }

    /**
     * @return mixed
     */
    public function getDateend()
    {
        return $this->dateend;
    }

    /**
     * @param mixed $date_end
     */
    public function setDateend($dateend)
    {
        $this->dateend = $dateend;
    }

    /**
     * @return mixed
     */
    public function getNumberplace()
    {
        return $this->numberplace;
    }

    /**
     * @param mixed $number_place
     */
    public function setNumberplace($numberplace)
    {
        $this->numberplace = $numberplace;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

}