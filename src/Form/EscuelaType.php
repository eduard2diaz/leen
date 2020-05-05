<?php

namespace App\Form;

use App\Entity\Escuela;
use App\Form\Subscriber\AddMunicipioEstadoFieldSubscriber;
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
            ->add('ccts',TextType::class,['label'=>'Clave del Centro de Trabajo del Plantel','attr'=>['class'=>'form-control']])
            ->add('d_codigo',null,['label'=>'Código Postal','placeholder'=>'Seleccione un código postal'])

            ->add('estado',null,['placeholder'=>'Seleccione un estado'])
            ->add('tipoasentamiento',null,['label'=>'Tipo de Asentamiento','placeholder'=>'Seleccione un tipo de asentamiento'])
            ->add('asentamiento',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
            ->add('calle',TextType::class,['required'=>false,'attr'=>['class'=>'form-control']])
            ->add('noexterior',TextType::class,['required'=>false,'label'=>'Número Exterior','attr'=>['class'=>'form-control']])
        ;


        $factory = $builder->getFormFactory();
        $builder->addEventSubscriber(new AddMunicipioEstadoFieldSubscriber($factory));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Escuela::class,
        ]);
    }
}
