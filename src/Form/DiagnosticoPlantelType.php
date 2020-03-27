<?php

namespace App\Form;

use App\Entity\DiagnosticoPlantel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DiagnosticoPlantelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroaulas')
            ->add('idcondicionesAula')
            ->add('numerosanitarios')
            ->add('idcondicionessanitarios')
            ->add('numerooficinas')
            ->add('idcondicionoficina')
            ->add('numerobibliotecas')
            ->add('idcondicionesbliblioteca')
            ->add('numeroaulasmedios')
            ->add('idcondicionaulamedios')
            ->add('numeropatio')
            ->add('idcondicionpatio')
            ->add('numerocanchasdeportivas')
            ->add('idcondicioncanchasdeportivas')
            ->add('numerobarda')
            ->add('idcondicionbarda')
            ->add('aguapotable')
            ->add('idcondicionagua')
            ->add('drenaje')
            ->add('idcondiciondrenaje')
            ->add('energiaelectrica')
            ->add('idcondicionenergia')
            ->add('telefono')
            ->add('idcondiciontelefono')
            ->add('internet')
            ->add('idcondicioninternet')
            ->add('iddiagnosticoplantel')
            ->add('diagnosticoarchivo')
            ->add('proyecto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => DiagnosticoPlantel::class,
        ]);
    }
}
