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
            ->add('d_tipoasenta',ChoiceType::class,['label'=>'Tipo de Asentamiento',
                'choices'=>[
                    'Aeropuerto'=>'Aeropuerto','Barrio'=>'Barrio','Campamento'=>'Campamento',
                    'Colonia'=>'Colonia','Condominio'=>'Condominio','Ejido'=>'Ejido',
                    'Equipamiento'=>'Equipamiento','Ex hacienda'=>'Ex hacienda','Fraccionamiento'=>'Fraccionamiento',
                    'Granja'=>'Granja','Hacienda'=>'Hacienda','Ingenio'=>'Ingenio',
                    'Parque Industrial'=>'Parque Industrial','Pueblo'=>'Pueblo','Rancho o Ranchería'=>'Rancho o Ranchería',
                    'Unidad Habitacional'=>'Unidad Habitacional','Zona Comercial'=>'Zona Comercial',
                    'Zona Industrial'=>'Zona Industrial',
                ],
                'attr'=>['class'=>'form-control']])

            ->add('d_zona',ChoiceType::class,['label'=>'Zona en la que se ubica el Asentamiento','choices'=>['Rural'=>'Rural','Urbana'=>'Urbana'],'attr'=>['class'=>'form-control']])
            ->add('d_cp',IntegerType::class,['label'=>'Código Postal de la Administración Postal que reparte el Asentamiento','attr'=>['class'=>'form-control']])

            ->add('id_asenta_cpcons',TextType::class,['label'=>'Identificador Único del Asentamiento(Nivel Municipal)','attr'=>['class'=>'form-control']])




            ->add('c_tipoasenta',IntegerType::class,['label'=>'Clave del Tipo de Asentamiento',

                'attr'=>['class'=>'form-control']])

            ->add('d_mpio',TextType::class,['label'=>'Nombre del Municipio','attr'=>['class'=>'form-control']])
            ->add('c_municipio',TextType::class,['label'=>'Clave del Municipio','attr'=>['class'=>'form-control']])
            ->add('d_estado',TextType::class,['label'=>'Nombre de la Entidad','attr'=>['class'=>'form-control']])
            ->add('c_estado',TextType::class,['label'=>'Clave de la Entidad','attr'=>['class'=>'form-control']])
            ->add('d_ciudad',TextType::class,['label'=>'Nombre de la Ciudad','attr'=>['class'=>'form-control']])
            ->add('c_CP',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('c_cve_ciudad',TextType::class,['label'=>'Clave de la Ciudad','attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CodigoPostal::class,
        ]);
    }
}
