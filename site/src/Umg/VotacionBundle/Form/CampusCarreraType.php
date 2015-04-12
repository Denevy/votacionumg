<?php

namespace Umg\VotacionBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampusCarreraType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Codigo')
            ->add('carrera')
            ->add('jornada')
            ->add('campus')
            ->add('catedratico','genemu_jqueryselect2_entity',array(
                'class' => 'Umg\VotacionBundle\Entity\Catedratico',
                'empty_value' => 'Seleccione coordinador',
                'required' => true,
                'configs' => array('width' => '1139px'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Umg\VotacionBundle\Entity\CampusCarrera'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'umg_votacionbundle_campuscarrera';
    }
}
