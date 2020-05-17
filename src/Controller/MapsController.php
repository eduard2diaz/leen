<?php

namespace App\Controller;

use App\Entity\Estado;
use App\Form\MapsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $form=$this->createForm(MapsType::class,[],['action'=>$this->generateUrl('maps_index')]);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest()) {
            $connectionParams = array(
                'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/Escuelav2?serverVersion=5.7',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            $conn->connect();

            $escuela=$request->request->get('maps')['escuela'];
            $estado=$request->request->get('maps')['estado'];
            $estadoObj=$this->getDoctrine()->getManager()
                            ->getRepository(Estado::class)->find($estado);

            if(!$estadoObj)
                throw new \Exception("Unable find Estado entity");

            $condicion="escuela.nom_ent LIKE '%".$estadoObj->getNombre()."%'";

            if($escuela!="")
                $condicion.=" AND escuela.nom_cct like '%".$escuela."%'";

            $consulta = "SELECT row_to_json(fc)
                            FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
                                    FROM (
                                        SELECT 'Feature' As type
                                        , ST_AsGeoJSON(esc.the_geom)::json As geometry
                                        , row_to_json(lp) As properties
                                        FROM escuela As esc
                                            INNER JOIN (SELECT cctt FROM escuela where ".$condicion.") As lp
                                                    ON esc.cctt = lp.cctt ) As f ) As fc;";

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
     * @Route("/findByCCTT", name="maps_findBycctt",options={"expose"=true})
     */
    public function findByCCTT(Request $request){
        if (!$request->isXmlHttpRequest() || !$request->request->has('cctt'))
            throw $this->createAccessDeniedException();

        $cctt=$request->request->get('cctt');
        $connectionParams = array(
            'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/Escuelav2?serverVersion=5.7',
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        $conn->connect();

       // $consulta = "Select row_to_json(p) from escuela as p where cctt='".$cctt."' limit 1";
        $consulta = "Select p.cctt as cctt, p.nom_ent as estado, p.nom_mun as municipio, p.nom_cct as nombre from escuela as p where cctt='".$cctt."' limit 1";

        $statement = $conn->query($consulta);
        $result = $statement->fetchAll();
        $conn->close();
        return $this->render('maps/info_escuela.html.twig',['escuela'=>$result[0]]);
       // return $this->json($result[0]['row_to_json']);
    }



}
