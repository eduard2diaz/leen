<?php

namespace App\Form;

use App\Entity\Ciudad;
use App\Form\Subscriber\AddMunicipioEstadoFieldSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CiudadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('clave', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('estado',null,['placeholder'=>'Seleccione un estado']);

        $factory = $builder->getFormFactory();
        $builder->addEventSubscriber(new AddMunicipioEstadoFieldSubscriber($factory));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ciudad::class,
        ]);
    }
}
