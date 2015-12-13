<?php

namespace WeatherBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WeatherBundle\Entity\DataSource;
use WeatherBundle\Form\DataSourceType;

/**
 * DataSource controller.
 *
 */
class DataSourceController extends Controller
{
    /**
     * Lists all DataSource entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $dataSources = $em->getRepository('WeatherBundle:DataSource')->findAll();

        return $this->render('WeatherBundle:DataSource:index.html.twig', array(
            'dataSources' => $dataSources,
        ));
    }

    /**
     * Creates a new DataSource entity.
     *
     */
    public function newAction(Request $request)
    {
        $dataSource = new DataSource();
        $form = $this->createForm(new DataSourceType(), $dataSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dataSource);
            $em->flush();

            return $this->redirectToRoute('datasource_show', array('id' => $datasource->getId()));
        }

        return $this->render('WeatherBundle:DataSource:new.html.twig', array(
            'dataSource' => $dataSource,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a DataSource entity.
     *
     */
    public function showAction(DataSource $dataSource)
    {
        $deleteForm = $this->createDeleteForm($dataSource);
        $cities = $dataSource->getCities()->getValues();

        return $this->render('WeatherBundle:DataSource:show.html.twig', array(
            'dataSource' => $dataSource,
            'cities' => $cities,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing DataSource entity.
     *
     */
    public function editAction(Request $request, DataSource $dataSource)
    {
        $deleteForm = $this->createDeleteForm($dataSource);
        $editForm = $this->createForm(new DataSourceType(), $dataSource);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dataSource);
            $em->flush();

            return $this->redirectToRoute('datasource_edit', array('id' => $dataSource->getId()));
        }

        return $this->render('WeatherBundle:DataSource:edit.html.twig', array(
            'dataSource' => $dataSource,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a DataSource entity.
     *
     */
    public function deleteAction(Request $request, DataSource $dataSource)
    {
        $form = $this->createDeleteForm($dataSource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($dataSource);
            $em->flush();
        }

        return $this->redirectToRoute('datasource_index');
    }

    /**
     * Creates a form to delete a DataSource entity.
     *
     * @param DataSource $dataSource The DataSource entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DataSource $dataSource)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('datasource_delete', array('id' => $dataSource->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
