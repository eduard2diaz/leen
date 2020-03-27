<?php

namespace App\Form;

use App\Entity\Direccion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DireccionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calle',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('numero_exterior',IntegerType::class,['label'=>'Número Exterior','attr'=>['class'=>'form-control']])
            ->add('d_codigo')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Direccion::class,
        ]);
    }
}
