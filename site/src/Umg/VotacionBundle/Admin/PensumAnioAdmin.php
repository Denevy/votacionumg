<?php

namespace Umg\VotacionBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;

class PensumAnioAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('curso')
            ->add('pensum')
        ;
    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper) 
    {
        $datagridMapper
            ->add('curso')
            ->add('pensum')
        ;
    }
    protected function ConfigureListFields(ListMapper $listMapper) 
    {
        $listMapper
            ->addIdentifier('id')
            ->add('curso')
            ->add('pensum')
        ;
    }
}