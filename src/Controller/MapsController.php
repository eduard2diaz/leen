<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Estado;
use App\Entity\Plantel;
use App\Form\MapsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maps")
 */
class MapsController extends AbstractController
{
    /**
     * @Route("/", name="maps_index",options={"expose"=true})
     */
    public function index(Request $request)
    {
        $form = $this->createForm(MapsType::class, [], ['action' => $this->generateUrl('maps_index')]);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest()) {
            $conn =$this->getDoctrine()->getConnection();

            $plantel = $request->request->get('maps')['plantel'];
            $estado = $request->request->get('maps')['estado'];
            $estadoObj = $this->getDoctrine()->getManager()
                ->getRepository(Estado::class)->find($estado);

            if (!$estadoObj)
                throw new \Exception("Unable find Estado entity");

            $condicion = "est.nombre LIKE '%" . $estadoObj->getNombre() . "%'";

            if ($plantel != "")
                $condicion .= "AND p2.nombre like '%" . $plantel . "%'";

            $consulta="SELECT row_to_json(fc)
       FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
       FROM ( SELECT 'Feature' As type
              , ST_AsGeoJSON(p.coord_geometry)::json As geometry
              , row_to_json(lp) As properties
               FROM plantel As p
               INNER JOIN (SELECT p2.id FROM plantel as p2 join estado as est 
						   ON (est.id = p2.estado_id) where " . $condicion . ") As lp
               ON p.id = lp.id ) As f ) As fc;";


            $statement = $conn->query($consulta);
            $result = $statement->fetchAll();
            return $this->json($result[0]['row_to_json']);
        }

        return $this->render('maps/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/findById", name="maps_findById",options={"expose"=true})
     */
    public function findById(Request $request)
    {
        if (!$request->isXmlHttpRequest() || !$request->request->has('id'))
            throw $this->createAccessDeniedException();

        $id = $request->request->get('id');

        $em=$this->getDoctrine()->getManager();
        $plantel=$em->getRepository(Plantel::class)->find($id);
        $result=['nombre'=>'Undefined','estado'=>'Undefined','municipio'=>'Undefined','escuelas'=>[]];
        if($plantel!=null){
            $result['nombre']=$plantel->getNombre();
            $result['estado']=$plantel->getEstado()->getNombre();
            $result['municipio']=$plantel->getMunicipio()->getNombre();
            foreach ($plantel->getEscuelas() as $escuela)
                $result['escuelas'][]=['nombre'=>$escuela->getNombre(),'ccts'=>$escuela->getCcts()];
        }

        return $this->render('maps/info_plantel.html.twig', ['plantel' => $result]);
    }


}
