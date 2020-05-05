<?php

namespace App\Form;

use App\Entity\Estado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre',TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>'off']])
            ->add('clave',TextType::class,['attr'=>['class'=>'form-control','autocomplete'=>'off']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Estado::class,
        ]);
    }
}
