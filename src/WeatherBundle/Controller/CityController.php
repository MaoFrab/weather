<?php

namespace WeatherBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WeatherBundle\Entity\City;
use WeatherBundle\Form\CityType;

/**
 * City controller.
 *
 */
class CityController extends Controller
{
    /**
     * Lists all City entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cities = $em->getRepository('WeatherBundle:City')->findAll();

        return $this->render('WeatherBundle:City:index.html.twig', array(
            'cities' => $cities,
        ));
    }

    /**
     * Creates a new City entity.
     *
     */
    public function newAction(Request $request)
    {
        $city = new City();
        $form = $this->createForm(new CityType(), $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            echo dump($city);
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('city_show', array('id' => $city->getId()));
        }

        return $this->render('WeatherBundle:City:new.html.twig', array(
            'city' => $city,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a City entity.
     *
     */
    public function showAction(City $city)
    {
        $deleteForm = $this->createDeleteForm($city);
        $dataSource = $city->getDataSource();

        /*dump($city);
        exit;*/

        return $this->render('WeatherBundle:City:show.html.twig', array(
            'city' => $city,
            'data_source' => $dataSource,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing City entity.
     *
     */
    public function editAction(Request $request, City $city)
    {
        $deleteForm = $this->createDeleteForm($city);
        $editForm = $this->createForm(new CityType(), $city);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($city);
            $em->flush();

            return $this->redirectToRoute('city_edit', array('id' => $city->getId()));
        }
        //dump($editForm->createView());
        //exit;

        return $this->render('WeatherBundle:City:edit.html.twig', array(
            'city' => $city,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a City entity.
     *
     */
    public function deleteAction(Request $request, City $city)
    {
        $form = $this->createDeleteForm($city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($city);
            $em->flush();
        }

        return $this->redirectToRoute('city_index');
    }

    /**
     * Creates a form to delete a City entity.
     *
     * @param City $city The City entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(City $city)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('city_delete', array('id' => $city->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function addDataSourceAction(City $city)
    {
        $editForm = $this->createForm(new CityType(), $city);
        $deleteForm = $this->createDeleteForm($city);

        return $this->render('WeatherBundle:City:add_data_source.html.twig', array(
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()
        ));
    }

    public function searchAction()
    {
        $request = $this->getRequest();
        $data = $request->query->get('search');

        //dump($data);
        //exit;


        $em = $this->getDoctrine()->getManager();
        $cities = $em->getRepository('WeatherBundle:City')->getCitiesByName($data);

        /*if(empty($cities))
            $error = "Результатов по запросу {$data} нет";*/


        return $this->render('WeatherBundle:City:index.html.twig', array(
            'cities' => $cities,
            //'error' => ($error ? $error : null)
        ));
    }
}
