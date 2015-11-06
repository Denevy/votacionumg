<?php

namespace Umg\VotacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CatedraticoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Codigo', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Nombre', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Direccion', 'textarea', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Nit', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('FechaNacimiento')
            ->add('Colegiado', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Especialidad', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Universidad', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Graduacion', 'text', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Estudios', 'textarea', array(
            'attr' => array('class' => 'form-control'),
            ))
            ->add('Logros', 'textarea', array(
            'attr' => array('class' => 'form-control'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\VotacionBundle\Entity\Catedratico'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_votacionbundle_catedratico';
    }
}
