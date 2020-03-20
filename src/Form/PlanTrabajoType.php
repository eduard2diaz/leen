<?php

namespace App\Form;

use App\Entity\PlanTrabajo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanTrabajoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechacaptura')
            ->add('descripcionaccion')
            ->add('tiempoestimado')
            ->add('costoestimado')
            ->add('totalrecursosasignados')
            ->add('planarchivo')
            ->add('proyecto')
            ->add('tipoAccion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanTrabajo::class,
        ]);
    }
}
