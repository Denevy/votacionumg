<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\Carrera;
use Umg\VotacionBundle\Form\CarreraType;

/**
 * Carrera controller.
 *
 * @Route("/carrera")
 */
class CarreraController extends Controller
{

    /**
     * Lists all Carrera entities.
     *
     * @Route("/", name="carrera")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('carreraTable');
        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        $em = $this->getDoctrine()->getManager();
        
        
        return array(
            'dataTable' => $dataTable,
        );
    }
    /**
     * Creates a new Carrera entity.
     *
     * @Route("/", name="carrera_create")
     * @Method("POST")
     * @Template("UmgVotacionBundle:Carrera:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Carrera();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carrera_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Carrera entity.
     *
     * @param Carrera $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Carrera $entity)
    {
        $form = $this->createForm(new CarreraType(), $entity, array(
            'action' => $this->generateUrl('carrera_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Guardar',
            'attr'  => array('class'=>'icon-save btn btn-success'),
            ));

        return $form;
    }

    /**
     * Displays a form to create a new Carrera entity.
     *
     * @Route("/new", name="carrera_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Carrera();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Carrera entity.
     *
     * @Route("/{id}", name="carrera_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Carrera entity.
     *
     * @Route("/{id}/edit", name="carrera_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Carrera entity.
    *
    * @param Carrera $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Carrera $entity)
    {
        $form = $this->createForm(new CarreraType(), $entity, array(
            'action' => $this->generateUrl('carrera_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Actualizar',
            'attr'  => array(
            'class'=>'icon-refresh btn btn-success'),
            ));

        return $form;
    }
    /**
     * Edits an existing Carrera entity.
     *
     * @Route("/{id}", name="carrera_update")
     * @Method("PUT")
     * @Template("UmgVotacionBundle:Carrera:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Carrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Carrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('carrera', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Carrera entity.
     *
     * @Route("/{id}", name="carrera_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgVotacionBundle:Carrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Carrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('carrera'));
    }

    /**
     * Creates a form to delete a Carrera entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('carrera_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => ' Borrar',
                'attr'  => array('class'=>'icon-eraser btn btn-danger'),
                ))
            ->getForm()
        ;
    }
}
