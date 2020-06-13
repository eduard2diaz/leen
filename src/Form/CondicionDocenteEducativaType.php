<?php

namespace App\Form;

use App\Entity\CondicionDocenteEducativa;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondicionDocenteEducativaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('ccts',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('curp',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('nombre',TextType::class,['attr'=>['class'=>'form-control']])
            ->add('grado',null,[
                'query_builder' => function (EntityRepository $repository){
                    $qb = $repository->createQueryBuilder('grado')
                        ->innerJoin('grado.tipoensenanza', 'te');

                    return $qb;
                }

            ])
           // ->add('diagnostico')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CondicionDocenteEducativa::class,
        ]);
    }
}
