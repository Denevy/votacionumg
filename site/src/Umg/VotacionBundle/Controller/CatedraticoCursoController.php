<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\CatedraticoCurso;
use Umg\VotacionBundle\Form\CatedraticoCursoType;

/**
 * CatedraticoCurso controller.
 *
 * @Route("/catedraticocurso")
 */
class CatedraticoCursoController extends Controller
{

    /**
     * Lists all CatedraticoCurso entities.
     *
     * @Route("/", name="catedraticocurso")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UmgVotacionBundle:CatedraticoCurso')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new CatedraticoCurso entity.
     *
     * @Route("/", name="catedraticocurso_create")
     * @Method("POST")
     * @Template("UmgVotacionBundle:CatedraticoCurso:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new CatedraticoCurso();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('carreracurso_show', array('id' => $entity->getCampusCursoId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a CatedraticoCurso entity.
     *
     * @param CatedraticoCurso $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(CatedraticoCurso $entity)
    {
        $form = $this->createForm(new CatedraticoCursoType(), $entity, array(
            'action' => $this->generateUrl('catedraticocurso_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Guardar',
            'attr'  => array('class' => 'icon-save btn btn-primary'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new CatedraticoCurso entity.
     *
     * @Route("/{id}/new", name="catedraticocurso_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $carrera = $em->getRepository('UmgVotacionBundle:CarreraCurso')->find($id);

        if (!$carrera) {
            throw $this->createNotFoundException('Unable to find CatedraticoCurso entity.');
        }

        $entity = new CatedraticoCurso();
        $entity->setCarreraCurso($carrera);
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a CatedraticoCurso entity.
     *
     * @Route("/{id}", name="catedraticocurso_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CatedraticoCurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CatedraticoCurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing CatedraticoCurso entity.
     *
     * @Route("/{id}/edit", name="catedraticocurso_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CatedraticoCurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CatedraticoCurso entity.');
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
    * Creates a form to edit a CatedraticoCurso entity.
    *
    * @param CatedraticoCurso $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(CatedraticoCurso $entity)
    {
        $form = $this->createForm(new CatedraticoCursoType(), $entity, array(
            'action' => $this->generateUrl('catedraticocurso_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Actualizar',
            'attr'  => array('class' => 'icon-refresh btn btn-primary'),
        ));

        return $form;
    }
    /**
     * Edits an existing CatedraticoCurso entity.
     *
     * @Route("/{id}", name="catedraticocurso_update")
     * @Method("PUT")
     * @Template("UmgVotacionBundle:CatedraticoCurso:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:CatedraticoCurso')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find CatedraticoCurso entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('carreracurso_show', array('id' => $entity->getCampusCursoId())));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a CatedraticoCurso entity.
     *
     * @Route("/{id}", name="catedraticocurso_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgVotacionBundle:CatedraticoCurso')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find CatedraticoCurso entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('catedraticocurso'));
    }

    /**
     * Creates a form to delete a CatedraticoCurso entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catedraticocurso_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => ' Borrar',
                'attr'  => array('class'=>'icon-eraser btn btn-info'),
                ))
            ->getForm()
        ;
    }
}