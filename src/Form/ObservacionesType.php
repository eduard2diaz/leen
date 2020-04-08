<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObservacionesType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
        $resolver->setDefaults(array('label'=>'Observaciones',
            'attr'=>array('class'=>'form-control')
        ));
    }

    public function getParent()
    {
        return TextareaType::class;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'observaciones';
    }

}
