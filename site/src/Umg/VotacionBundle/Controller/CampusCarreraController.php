<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\CampusCarrera;
use Umg\VotacionBundle\Form\CampusCarreraType;

/**
 * CampusCarrera controller.
 *
 * @Route("/campuscarrera")
 */
class CampusCarreraController extends Controller
{

    /**
     * Lists all CampusCarrera entities.
     *
     * @Route("/", name="campuscarrera")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgVotacionBundle:CampusCarrera')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CampusCarrera entity.
     *
     * @Route("/", name="campuscarrera_create")
     * @Method("POST")
     * @Template("UmgVotacionBundle:CampusCarrera:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CampusCarrera();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campuscarrera_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CampusCarrera entity.
     *
     * @param CampusCarrera $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CampusCarrera $entity)
    {
        $form = $this->createForm(new CampusCarreraType(), $entity, array(
            'action' => $this->generateUrl('campuscarrera_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new CampusCarrera entity.
     *
     * @Route("/new", name="campuscarrera_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new CampusCarrera();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CampusCarrera entity.
     *
     * @Route("/{id}", name="campuscarrera_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CampusCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampusCarrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CampusCarrera entity.
     *
     * @Route("/{id}/edit", name="campuscarrera_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CampusCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampusCarrera entity.');
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
    * Creates a form to edit a CampusCarrera entity.
    *
    * @param CampusCarrera $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CampusCarrera $entity)
    {
        $form = $this->createForm(new CampusCarreraType(), $entity, array(
            'action' => $this->generateUrl('campuscarrera_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing CampusCarrera entity.
     *
     * @Route("/{id}", name="campuscarrera_update")
     * @Method("PUT")
     * @Template("UmgVotacionBundle:CampusCarrera:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CampusCarrera')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CampusCarrera entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('campuscarrera_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CampusCarrera entity.
     *
     * @Route("/{id}", name="campuscarrera_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgVotacionBundle:CampusCarrera')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CampusCarrera entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campuscarrera'));
    }

    /**
     * Creates a form to delete a CampusCarrera entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campuscarrera_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
