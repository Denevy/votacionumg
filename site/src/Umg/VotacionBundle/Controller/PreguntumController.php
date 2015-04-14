<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\Preguntum;
use Umg\VotacionBundle\Entity\OpcionPreguntum;
use Umg\VotacionBundle\Entity\Opcion;
use Umg\VotacionBundle\Form\PreguntumType;

/**
 * Preguntum controller.
 *
 * @Route("/preguntum")
 */
class PreguntumController extends Controller
{

    /**
     * Lists all Preguntum entities.
     *
     * @Route("/", name="preguntum")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgVotacionBundle:Preguntum')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Preguntum entity.
     *
     * @Route("/", name="preguntum_create")
     * @Method("POST")
     * @Template("UmgVotacionBundle:Preguntum:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Preguntum();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('evaluacion_show', array('id' => $entity->getEvaluacion()->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Preguntum entity.
     *
     * @param Preguntum $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Preguntum $entity)
    {
        $form = $this->createForm(new PreguntumType(), $entity, array(
            'action' => $this->generateUrl('preguntum_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Guardar',
            'attr'  => array('class' => 'btn btn-primary'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Preguntum entity.
     *
     * @Route("/{id}/new", name="preguntum_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('UmgVotacionBundle:Evaluacion')->find($id);

        if (!$evaluacion) {
            throw $this->createNotFoundException('Unable to find Evaluacion entity.');
        }

        $entity = new Preguntum();
        $entity->setEvaluacion($evaluacion);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Preguntum entity.
     *
     * @Route("/{id}", name="preguntum_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Preguntum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Preguntum entity.
     *
     * @Route("/{id}/edit", name="preguntum_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Preguntum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntum entity.');
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
    * Creates a form to edit a Preguntum entity.
    *
    * @param Preguntum $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Preguntum $entity)
    {
        $form = $this->createForm(new PreguntumType(), $entity, array(
            'action' => $this->generateUrl('preguntum_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Actualizar',
            'attr'  => array('class' => 'btn btn-primary'),
        ));

        return $form;
    }
    /**
     * Edits an existing Preguntum entity.
     *
     * @Route("/{id}", name="preguntum_update")
     * @Method("PUT")
     * @Template("UmgVotacionBundle:Preguntum:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Preguntum')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Preguntum entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('preguntum_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Preguntum entity.
     *
     * @Route("/{id}", name="preguntum_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgVotacionBundle:Preguntum')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Preguntum entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('preguntum'));
    }

    /**
     * Creates a form to delete a Preguntum entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('preguntum_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
