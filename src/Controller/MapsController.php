<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Estado;
use App\Entity\Plantel;
use App\Form\MapsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\VarDumper\Dumper\esc;

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
        $estados = $this->obtenerEstados();
        $form = $this->createForm(MapsType::class, [], ['estados' => $estados, 'action' => $this->generateUrl('maps_index')]);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest()) {
            $escuela = $request->request->get('maps')['escuela'];
            $estado = $request->request->get('maps')['estado'];

            $condicion = "esc.nom_ent='".$estado."'";

            if ($escuela != "")
                $condicion .= " AND esc.nom_cct like '%" . $escuela . "%'";

            $consulta = "SELECT row_to_json(fc)
                            FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
                                    FROM (
                                        SELECT 'Feature' As type
                                        , ST_AsGeoJSON(esc.the_geom)::json As geometry
                                        , row_to_json(lp) As properties
                                        FROM escuela As esc
                                            INNER JOIN (SELECT cctt FROM escuela) As lp
                                                    ON esc.cctt = lp.cctt
                                                    WHERE " . $condicion . "
                                ) As f ) As fc  ;";

            $result=$this->executeQuery($consulta);
            return $this->json($result[0]['row_to_json']);
        }

        return $this->render('maps/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/findBycctt", name="maps_findBycctt",options={"expose"=true})
     */
    public function findBycctt(Request $request)
    {
        if (!$request->isXmlHttpRequest() || !$request->request->has('cctt'))
            throw $this->createAccessDeniedException();

        $cctt = $request->request->get('cctt');
        $consulta="select nom_ent as estado, nom_cct as nombre, nom_mun as municipio from escuela where cctt ='".$cctt."' LIMIT 1";
        $result = ['nombre' => 'Undefined', 'estado' => 'Undefined', 'municipio' => 'Undefined'];

        $query_result=$this->executeQuery($consulta);
        if (!empty($query_result)) {
            $result['nombre'] = $query_result[0]['nombre'];
            $result['estado'] = $query_result[0]['estado'];
            $result['municipio'] = $query_result[0]['municipio'];
        }

        return $this->render('maps/info_plantel.html.twig', ['plantel' => $result]);
    }

    private function obtenerEstados()
    {
        $query = "select DISTINCT(e.nom_ent) as nombre from escuela as e";
        return $this->executeQuery($query);
    }

    private function executeQuery($query)
    {
        $connectionParams = array(
            'dbname' => 'prueba',
            'user' => 'postgres',
            'password' => 'postgres',
            'host' => 'localhost',
            'driver' => 'pdo_pgsql',
        );
        $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
        $conn->connect();
        if (!$conn->isConnected())
            throw new \Exception('No se puedo establecer la conexión al servidor de mapas');
        $result = $conn->fetchAll($query);
        $conn->close();
        return $result;
    }



}
