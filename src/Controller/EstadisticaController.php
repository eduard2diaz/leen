<?php

namespace App\Controller;

use App\Form\EstadisticaLocalidadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estadistica")
 */
class EstadisticaController extends AbstractController
{
    /**
     * @Route("/localidad", name="estadistica_resumen_por_localidad")
     */
    public function localidad(Request $request)
    {
        $form=$this->createForm(EstadisticaLocalidadType::class,null,['action'=>$this->generateUrl('estadistica_resumen_por_localidad')]);
        if($request->isMethod('POST')){
            $parameters=$request->request->all();
            $estado=$parameters["estadistica_localidad"]["estado"];
            $municipio=$parameters["estadistica_localidad"]["municipio"];
            $ciudad=$parameters["estadistica_localidad"]["ciudad"];
            $em=$this->getDoctrine()->getManager();

            $query_string='SELECT esc FROM App:Escuela esc JOIN esc.estado est WHERE est.id= :estado';
            $query_parameters=['estado'=>$estado];
            if($municipio!=null){
                $query_string='SELECT esc FROM App:Escuela esc JOIN esc.estado est JOIN esc.municipio mun WHERE est.id= :estado OR mun.id= :municipio';
                $query_parameters['municipio']=$municipio;
            }

            $consulta=$em->createQuery($query_string);
            $consulta->setParameters($query_parameters);
            $result=$consulta->getResult();
            return $this->render('estadistica/localidad.html.twig', [
                'form' => $form->createView(),
                'result'=>$result
            ]);
        }
        return $this->render('estadistica/localidad.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
