<?php

namespace App\Form;

use App\Entity\TipoCondicion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipoCondicionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('condicion',TextType::class,['label'=>'Condición','attr'=>['class'=>'form-control','autocomplete'=>'off']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TipoCondicion::class,
        ]);
    }
}
