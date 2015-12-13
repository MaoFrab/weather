<?php

namespace WeatherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WeatherBundle\Entity\City;
use WeatherBundle\Entity\DataSource;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('WeatherBundle:DataSource')->findById(2);




        $ds = new DataSource();
        $ds->setLocation(array(12, 45));
        $ds->setName('Fastov_source');
        $ds->setTemperature(24);

        $city = new City();
        $city->setName('Fastov');
        $city->setCityLocation(array(12, 74));
        $city->setPopulation(50000);

        /*$ds->addCity($city);

        $em->persist($ds);

        $em->persist($city);
        $em->flush();*/

        foreach($entity as $a)
        {
            echo dump(($a->getCities()->getValues()));

        }
        exit;

        return $this->render('WeatherBundle:Default:index.html.twig');
    }
}
