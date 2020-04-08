<?php

namespace App\Form;

use App\Entity\Proyecto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\Transformer\DatetoStringTransformer;

class ProyectoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero',TextType::class,['label'=>'Número','attr'=>['class'=>'form-control','autocomplete' => 'off']])
            ->add('fechainicio',TextType::class,['label'=>'Fecha de Inicio','attr'=>['class'=>'form-control', 'pattern'=>'\d{4}-\d{2}-\d{2}',
                'autocomplete' => 'off']])
            ->add('fechafin',TextType::class,['label'=>'Fecha de Fin','attr'=>['class'=>'form-control', 'pattern'=>'\d{4}-\d{2}-\d{2}',
                'autocomplete' => 'off',]])
            ->add('montoasignado',NumberType::class,['label'=>'Monto Asignado','attr'=>['class'=>'form-control']])
            ->add('montogastado',NumberType::class,['label'=>'Monto Gastado','attr'=>['class'=>'form-control']])
            ->add('saldofinal',NumberType::class,['label'=>'Saldo Asignado','attr'=>['class'=>'form-control']])
            ->add('escuela')
        ;

        $builder->get('fechainicio')->addModelTransformer(new DatetoStringTransformer());
        $builder->get('fechafin')->addModelTransformer(new DatetoStringTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Proyecto::class,
        ]);
    }
}
