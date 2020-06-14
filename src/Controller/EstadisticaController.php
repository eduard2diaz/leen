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
     * @Route("/localidad", name="estadistica_escuela_localidad")
     */
    public function localidad(Request $request, PaginatorInterface $paginator)
    {
        $form=$this->createForm(EstadisticaLocalidadType::class,null,['action'=>$this->generateUrl('estadistica_escuela_localidad')]);

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
     * @Route("/escuela/proyectos", name="estadistica_escuela_proyectos")
     */
    public function proyectos(Request $request, PaginatorInterface $paginator)
    {
        //PAGINANDO CONSULTAS SQL
        $query="Select * FROM escuelas_con_proyecto_view";
        $query2="SELECT * FROM total_escuelas_view";
        $total=$this->prepareDatabaseQuery($query2)[0]["count"];
        $escuelas=$this->preparePaginateDatabaseQuery($query,$request,$paginator);
        $con_proyectos=$escuelas->getTotalItemCount();

        return $this->render('estadistica/escuelaproyectos.html.twig', [
            'escuelas' => $escuelas,
            'proyectos_count'=>$con_proyectos,
            'withoutproyectos_count'=>$total-$con_proyectos
        ]);
    }

    /**
     * @Route("/escuela/proyectos/{estatus<Activo|Inactivo|Cancelado|Eliminado>}", name="estadistica_escuela_proyectos_estatus")
     */
    public function proyectosEstatus($estatus,Request $request, PaginatorInterface $paginator)
    {
        //PAGINANDO CONSULTAS SQL
        $query="select * from  proyectoEstatus('".$estatus."')";
        $escuelas=$this->preparePaginateDatabaseQuery($query,$request,$paginator);

        return $this->render('estadistica/escuelaproyectosestatus.html.twig', [
            'escuelas' => $escuelas,
            'estatus'=>$estatus
        ]);
    }


    /**
     * @Route("/escuela/sanitario", name="estadistica_escuela_sin_sanitarios", methods={"GET"})
     */
    public function sanitario(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_sanitarios_view";

        return $this->render('estadistica/escuelasinsanitario.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    /**
     * @Route("/escuela/biblioteca", name="estadistica_escuela_sin_biblioteca", methods={"GET"})
     */
    public function biblioteca(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_bibliotecas_view";

        return $this->render('estadistica/escuelasinbiblioteca.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    /**
     * @Route("/escuela/aguapotable", name="estadistica_escuela_sin_aguapotable", methods={"GET"})
     */
    public function aguapotable(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_aguapotable_view";

        return $this->render('estadistica/escuelasinaguapotable.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    /**
     * @Route("/escuela/drenaje", name="estadistica_escuela_sin_drenaje", methods={"GET"})
     */
    public function drenaje(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_drenaje_view";

        return $this->render('estadistica/escuelasindrenaje.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    /**
     * @Route("/escuela/electricidad", name="estadistica_escuela_sin_electricidad", methods={"GET"})
     */
    public function electricidad(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_electricidad_view";

        return $this->render('estadistica/escuelasinelectricidad.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    /**
     * @Route("/escuela/internet", name="estadistica_escuela_sin_internet", methods={"GET"})
     */
    public function internet(Request $request, PaginatorInterface $paginator): Response
    {
        $query = "Select * from escuelas_sin_internet_view";

        return $this->render('estadistica/escuelasininternet.html.twig', [
            'escuelas' => $this->preparePaginateDatabaseQuery($query,$request,$paginator),
        ]);
    }

    private function preparePaginateDatabaseQuery($query,$request,$paginator){
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        $aux=$stmt->fetchAll();
        //$request=$this->get('request_stack')->getCurrentRequest();
        $result = $paginator->paginate(
            $aux,
            $request->query->getInt('page', 1),
            $this->getParameter('knp_num_items_per_page')
        );
        return $result;
    }

    private function prepareDatabaseQuery($query){
        $em = $this->getDoctrine()->getManager();
        $db = $em->getConnection();
        $stmt = $db->prepare($query);
        $params = array();
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

}
