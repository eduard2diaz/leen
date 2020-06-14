<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Estado;
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
            $connectionParams = array(
                'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/leen21?serverVersion=5.7',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            $conn->connect();

            $escuela = $request->request->get('maps')['escuela'];
            $estado = $request->request->get('maps')['estado'];
            $estadoObj = $this->getDoctrine()->getManager()
                ->getRepository(Estado::class)->find($estado);

            if (!$estadoObj)
                throw new \Exception("Unable find Estado entity");

            $condicion = "est.nombre LIKE '%" . $estadoObj->getNombre() . "%'";

            if ($escuela != "")
                $condicion .= "AND esc2.escuela like '%" . $escuela . "%'";

            $consulta = "SELECT row_to_json(fc)
       FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
       FROM ( SELECT 'Feature' As type
              , ST_AsGeoJSON(esc.coordenada)::json As geometry
              , row_to_json(lp) As properties
               FROM escuela As esc
               INNER JOIN (SELECT esc2.id FROM escuela as esc2 join estado as est 
						   ON (est.id = esc2.estado_id) where " . $condicion . ") As lp
               ON esc.id = lp.id ) As f ) As fc;";

            $statement = $conn->query($consulta);
            $result = $statement->fetchAll();
            $conn->close();
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
        $escuela=$em->getRepository(Escuela::class)->find($id);
        $result=['nombre'=>'Undefined','estado'=>'Undefined','municipio'=>'Undefined','cctt'=>'Undefined'];
        if($escuela!=null){
            $result['nombre']=$escuela->getEscuela();
            $result['estado']=$escuela->getEstado()->getNombre();
            $result['municipio']=$escuela->getMunicipio()->getNombre();
            $result['cctt']=$escuela->getccts_collection()->first()->getValue();
        }

        return $this->render('maps/info_escuela.html.twig', ['escuela' => $result]);
    }


}
