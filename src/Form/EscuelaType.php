<?php

namespace App\Form;

use App\Entity\Escuela;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EscuelaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('escuela',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('ccts',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('d_codigo',CodigoPostalType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Escuela::class,
        ]);
    }
}
