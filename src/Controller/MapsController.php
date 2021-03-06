<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Estado;
use App\Entity\Plantel;
use App\Form\MapsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

            $condicion = "e1.nom_ent='".$estado."'";

            if ($request->request->has('municipio')) {
                $municipio = $request->request->get('maps')['municipio'];
                if ($municipio != "")
                    $condicion .= " AND e1.nom_mun='" . $municipio . "'";
            }

            if ($escuela != "")
                $condicion .= " AND (e2.nombre like '%" . $escuela . "%' OR e2.ccts='$escuela')";

            $consulta="SELECT row_to_json(fc)
                            FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
                                    FROM (
                                        SELECT 'Feature' As type
                                        , gis.ST_AsGeoJSON(esc.the_geom)::json As geometry
                                        , row_to_json(lp) As properties
                                        FROM gis.escuela As esc
                                            INNER JOIN (SELECT cctt FROM gis.escuela as e1 join public.escuela as e2 on(e1.cct=e2.ccts) WHERE " . $condicion . ") As lp
                                                    ON esc.cctt = lp.cctt
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
        $consulta="select nom_ent as estado, nom_cct as nombre, nom_mun as municipio from gis.escuela where cctt ='".$cctt."' LIMIT 1";
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
        $query = "select DISTINCT(e.nom_ent) as nombre from gis.escuela as e ORDER BY e.nom_ent ASC";
        return $this->executeQuery($query);
    }

    /**
     * @Route("/{estado}/findByEstado", name="maps_municipio_findby_estado",options={"expose"=true})
     */
    public function obtenerMunicipios(Request $request, $estado)
    {
        if(!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $query = "Select array_to_json(array_agg(data)) from(
                  select DISTINCT(e.nom_mun) as nombre from gis.escuela as e
                  WHERE e.nom_ent='$estado' ORDER BY e.nom_mun ASC) as data";
        $municipios=$this->executeQuery($query);
        return $this->json($municipios[0]['array_to_json']);
    }

    private function executeQuery($query)
    {
        $conn = $this->getDoctrine()->getConnection();
        $conn->connect();
        if (!$conn->isConnected())
            throw new \Exception('No se puedo establecer la conexión al servidor de mapas');
        $result = $conn->fetchAll($query);
        $conn->close();
        return $result;
    }



}
