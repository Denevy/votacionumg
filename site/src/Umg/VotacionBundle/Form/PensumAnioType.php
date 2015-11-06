<?php

namespace Umg\VotacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PensumAnioType extends AbstractType
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
            ->add('curso', null, array(
            'attr' => array('class' => 'form-control m-bot15'),
            ))
            ->add('carrera', null, array(
            'attr' => array('class' => 'form-control m-bot15'),
            ))
            ->add('pensum', null, array(
            'attr' => array('class' => 'form-control m-bot15'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\VotacionBundle\Entity\PensumAnio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_votacionbundle_pensumanio';
    }
}
