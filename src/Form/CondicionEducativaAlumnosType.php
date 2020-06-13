<?php

namespace App\Form;

use App\Entity\CondicionEducativaAlumnos;
use App\Entity\Escuela;
use App\Entity\EscuelaCCTS;
use App\Entity\GradoEnsenanza;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CondicionEducativaAlumnosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $escuela = $options['escuela'];
        $builder
            ->add('numalumnas',IntegerType::class,['label'=>'Número de alumnas','attr'=>['class'=>'form-control']])
            ->add('numalumnos',IntegerType::class,['label'=>'Número de alumnos','attr'=>['class'=>'form-control']])
            ->add('grado', null, [
                'placeholder' => 'Seleccione un grado',
                'auto_initialize' => false,
                'class' => GradoEnsenanza::class,
                'query_builder' => function (EntityRepository $repository) use ($escuela) {
                    $res = $repository->createQueryBuilder('escuela');
                    $res->select('e')->from(Escuela::class, 'e');
                    $res->join('e.tipoensenanza', 'te');
                    $res->where('e.id = :id')->setParameter('id', $escuela);
                    $escuelaObj = $res->getQuery()->getOneOrNullResult();

                    $tipo_ensenanza_list = [1];
                    foreach ($escuelaObj->getTipoensenanza() as $te)
                        $tipo_ensenanza_list[] = $te->getId();

                    $qb = $repository->createQueryBuilder('grado')
                        ->innerJoin('grado.tipoensenanza', 'te')
                        ->where('te.id IN (:list)')->setParameter('list', $tipo_ensenanza_list);

                    return $qb;
                },
                'group_by' => function ($choiceValue, $key, $value) {
                    return $choiceValue->getTipoensenanza()->getNombre();
                },
            ])
            ->add('ccts', EntityType::class, array(
                'label' => 'Clave del centro de trabajo',
                'class' => EscuelaCCTS::class,
                'required' => true,
                'query_builder' => function (EntityRepository $repository) use ($escuela) {
                    $qb = $repository->createQueryBuilder('ccts')
                        ->innerJoin('ccts.escuela', 'e');
                    if ($escuela instanceof Escuela) {
                        $qb->where('e.id = :id')
                            ->setParameter('id', $escuela);
                    } elseif (is_numeric($escuela)) {
                        $qb->where('e.id = :id')
                            ->setParameter('id', $escuela);
                    } else {
                        $qb->where('e.id = :id')
                            ->setParameter('id', null);
                    }
                    return $qb;
                }

            , 'attr' => array('class' => 'form-control input-medium')));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CondicionEducativaAlumnos::class,
        ]);
        $resolver->setRequired(['escuela']);
    }
}
