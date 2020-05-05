<?php

namespace App\Controller;

use App\Form\EstadisticaLocalidadType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estadistica")
 */
class EstadisticaController extends AbstractController
{
    /**
     * @Route("/localidad", name="estadistica_resumen_por_localidad")
     */
    public function localidad(Request $request, PaginatorInterface $paginator)
    {
        $form=$this->createForm(EstadisticaLocalidadType::class,null,['action'=>$this->generateUrl('estadistica_resumen_por_localidad')]);

        $parametersPOST=$request->request->all();
        $parametersGET=$request->query->all();
        $parameters= $request->isMethod('POST') ? $parametersPOST["estadistica_localidad"] : $parametersGET;
        if(array_key_exists("estado",$parameters)){
            $estado=$parameters["estado"];
            $municipio=$parameters["municipio"];
            $em=$this->getDoctrine()->getManager();
            $query_string='SELECT esc FROM App:Escuela esc JOIN esc.estado est WHERE est.id= :estado';
            $query_parameters=['estado'=>$estado];
            if($municipio!=null && $municipio!='-1'){
                $query_string='SELECT esc FROM App:Escuela esc JOIN esc.estado est JOIN esc.municipio mun WHERE est.id= :estado AND mun.id= :municipio';
                $query_parameters['municipio']=$municipio;
            }

            $consulta=$em->createQuery($query_string);
            $consulta->setParameters($query_parameters);

            $result = $paginator->paginate(
                $consulta, /* query NOT result */
                $request->query->getInt('page', 1),
                $this->getParameter('knp_num_items_per_page')
            );

            return $this->render('estadistica/localidad.html.twig', [
                'form' => $form->createView(),
                'estado'=>$estado,
                'municipio'=>$municipio,
                'result'=>$result
            ]);
        }
        return $this->render('estadistica/localidad.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/escuela/sanitario", name="escuela_sin_sanitarios", methods={"GET"})
     */
    public function sanitario(Request $request, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT d,p,e FROM App:DiagnosticoPlantel d JOIN d.proyecto p JOIN p.escuela e WHERE d.numerosanitarios=0 GROUP BY d.id,p.id, e ORDER BY ";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $escuelas = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $this->getParameter('knp_num_items_per_page')
        );

        return $this->render('estadistica/escuelasinsanitario.html.twig', [
            'escuelas' => $escuelas,
        ]);
    }
}
