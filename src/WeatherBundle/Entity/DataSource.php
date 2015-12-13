<?php

namespace WeatherBundle\Entity;

/**
 * DataSource
 */
class DataSource
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
     * @var string
     */
    private $temperature;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $cities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return DataSource
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
     * Set temperature
     *
     * @param string $temperature
     *
     * @return DataSource
     */
    public function setTemperature($temperature)
    {
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * Get temperature
     *
     * @return string
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     *
     * @return DataSource
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
     * @return DataSource
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
     * Add city
     *
     * @param \WeatherBundle\Entity\City $city
     *
     * @return DataSource
     */
    public function addCity(\WeatherBundle\Entity\City $city)
    {
        $this->cities[] = $city;

        return $this;
    }

    /**
     * Remove city
     *
     * @param \WeatherBundle\Entity\City $city
     */
    public function removeCity(\WeatherBundle\Entity\City $city)
    {
        $this->cities->removeElement($city);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCities()
    {
        return $this->cities;
    }

    public function __toString()
    {
        return $this->getName();
    }
}

