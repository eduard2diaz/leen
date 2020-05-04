<?php

namespace App\Form;

use App\Entity\PlanTrabajo;
use App\Form\Transformer\DatetoStringTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $required=!$options['data']->getId() ? true : false;
        $builder
            ->add('fechacaptura',TextType::class,['label'=>'Fecha de captura','attr'=>['class'=>'form-control', 'pattern'=>'\d{4}-\d{2}-\d{2}','autocomplete' => 'off']])
            ->add('descripcionaccion',TextareaType::class,['label'=>'Descripción','attr'=>['class'=>'form-control']])
            ->add('tiempoestimado',TextType::class,['label'=>'Tiempo estimado','attr'=>['class'=>'form-control']])
            ->add('costoestimado',NumberType::class,['label'=>'Costo estimado','attr'=>['class'=>'form-control']])
            ->add('totalrecursosasignados',NumberType::class,['label'=>'Total de recursos asignados','attr'=>['class'=>'form-control']])
            ->add('proyecto')
            ->add('tipoAccion',null,['label'=>'Tipo de acción'])
            ->add('file', FileType::class, array('label'=>' ','required' => $required))
        ;

        $builder->get('fechacaptura')->addModelTransformer(new DatetoStringTransformer());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanTrabajo::class,
        ]);
    }
}
