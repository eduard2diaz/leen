<?php

namespace App\Form;

use App\Entity\CodigoPostal;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CodigoPostalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('d_Asenta',TextType::class,['label'=>'Nombre del Asentamiento','attr'=>['class'=>'form-control']])
            ->add('tipoasentamiento',null,['label'=>'Tipo de Asentamiento'])
            ->add('d_zona',ChoiceType::class,['label'=>'Zona en la que se ubica el Asentamiento','choices'=>['Rural'=>'Rural','Urbana'=>'Urbana'],'attr'=>['class'=>'form-control']])
            ->add('d_cp',IntegerType::class,['label'=>'Código Postal de la Administración Postal que reparte el Asentamiento','attr'=>['class'=>'form-control']])
            ->add('id_asenta_cpcons',TextType::class,['label'=>'Identificador Único del Asentamiento(Nivel Municipal)','attr'=>['class'=>'form-control']])
            ->add('municipio',null)
            ->add('estado',null)
            ->add('ciudad',null)
            ->add('c_CP',TextType::class,['attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CodigoPostal::class,
        ]);
    }
}
