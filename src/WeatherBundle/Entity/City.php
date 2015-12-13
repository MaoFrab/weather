<?php

namespace WeatherBundle\Entity;

/**
 * City
 */
class City
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $population;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var \WeatherBundle\Entity\DataSource
     */
    private $dataSource;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return City
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set population
     *
     * @param integer $population
     *
     * @return City
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return integer
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     *
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set dataSource
     *
     * @param \WeatherBundle\Entity\DataSource $dataSource
     *
     * @return City
     */
    public function setDataSource(\WeatherBundle\Entity\DataSource $dataSource = null)
    {
        $this->dataSource = $dataSource;

        return $this;
    }

    /**
     * Get dataSource
     *
     * @return \WeatherBundle\Entity\DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

