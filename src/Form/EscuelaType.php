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
            ->add('ccts',TextType::class,['label'=>'Clave del Centro de Trabajo del Plantel o la Escuela','attr'=>['class'=>'form-control']])
            ->add('d_codigo',null,['label'=>'Código Postal'])

            ->add('estado',null)
            ->add('municipio',null)
            ->add('tipoasentamiento',null,['label'=>'Tipo de Asentamiento'])
            ->add('asentamiento',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
            ->add('calle',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
            ->add('noexterior',TextType::class,['required'=>false,'label'=>'Número Exterior','attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Escuela::class,
        ]);
    }
}
