<?php

namespace Umg\VotacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EvaluacionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Activa')
            ->add('FechaHora','datetime',array(
                'date_widget' => "single_text", 
                'time_widget' => "single_text"
            ))
            ->add('FechaHoraFinal','datetime',array(
                'date_widget' => "single_text", 
                'time_widget' => "single_text"
            ))
            ->add('campusCarrera', null , array(
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
            'data_class' => 'Umg\VotacionBundle\Entity\Evaluacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_votacionbundle_evaluacion';
    }
}
