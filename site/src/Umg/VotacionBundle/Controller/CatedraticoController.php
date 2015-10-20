<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\Catedratico;
use Umg\VotacionBundle\Form\CatedraticoType;

/**
 * Catedratico controller.
 *
 * @Route("/catedratico")
 */
class CatedraticoController extends Controller
{

    /**
     * Lists all Catedratico entities.
     *
     * @Route("/", name="catedratico")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $dataTable = $this->get('data_tables.manager')->getTable('catedraticoTable');
        if ($response = $dataTable->ProcessRequest($request)) {
            return $response;
        }

        $em = $this->getDoctrine()->getManager();


        return array(
            'dataTable' => $dataTable,
        );
    }
    /**
     * Creates a new Catedratico entity.
     *
     * @Route("/", name="catedratico_create")
     * @Method("POST")
     * @Template("UmgVotacionBundle:Catedratico:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Catedratico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->getConnection()->beginTransaction();
            try
            {
                $em->persist($entity);
                $em->flush();

                $userManager = $this->container->get('fos_user.user_manager');
                $userAdmin = $userManager->createUser();

                $userAdmin->setUsername($entity->getCodigo());
                $userAdmin->setEmail($entity->getCodigo().'cat@example.com');
                $userAdmin->setPlainPassword($entity->getColegiado().$entity->getNit());
                $userAdmin->setEnabled(true);
                $userManager->updateUser($userAdmin, true);

                $entity->setUsuario($userAdmin);
                $em->persist($entity);
                $em->flush();

                $em->getConnection()->commit();
                return $this->redirect($this->generateUrl('catedratico'));
            }
            catch (Exception $e)
            {
                $em->getConnection()->rollback();
                return array(
                    'entity' => $entity,
                    'form'   => $form->createView(),
                );
                throw $e;
            }
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Catedratico entity.
     *
     * @param Catedratico $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Catedratico $entity)
    {
        $form = $this->createForm(new CatedraticoType(), $entity, array(
            'action' => $this->generateUrl('catedratico_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => 'Guardar',
            'attr'  => array('class' => 'btn btn-primary'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Catedratico entity.
     *
     * @Route("/new", name="catedratico_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Catedratico();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Catedratico entity.
     *
     * @Route("/{id}", name="catedratico_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Catedratico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catedratico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Catedratico entity.
     *
     * @Route("/{id}/edit", name="catedratico_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Catedratico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catedratico entity.');
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
    * Creates a form to edit a Catedratico entity.
    *
    * @param Catedratico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Catedratico $entity)
    {
        $form = $this->createForm(new CatedraticoType(), $entity, array(
            'action' => $this->generateUrl('catedratico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Actualizar',
            'attr'  => array('class' => 'btn btn-success fa fa-refresh'),
        ));

        return $form;
    }
    /**
     * Edits an existing Catedratico entity.
     *
     * @Route("/{id}", name="catedratico_update")
     * @Method("PUT")
     * @Template("UmgVotacionBundle:Catedratico:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UmgVotacionBundle:Catedratico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Catedratico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('catedratico_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Catedratico entity.
     *
     * @Route("/{id}", name="catedratico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UmgVotacionBundle:Catedratico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Catedratico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('catedratico'));
    }

    /**
     * Creates a form to delete a Catedratico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('catedratico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array(
                'label' => ' Borrar',
                'attr'  => array('class' => 'btn btn-danger fa fa-pencil'),))
            ->getForm()
        ;
    }
}
