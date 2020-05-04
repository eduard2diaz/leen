<?php

namespace App\Controller;

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
        if ($request->isXmlHttpRequest()) {
            $connectionParams = array(
                'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/Escuelav2?serverVersion=5.7',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            $conn->connect();

            $consulta = "SELECT row_to_json(fc)
                            FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
                                    FROM (
                                        SELECT 'Feature' As type
                                        , ST_AsGeoJSON(esc.the_geom)::json As geometry
                                        , row_to_json(lp) As properties
                                        FROM escuela As esc
                                            INNER JOIN (SELECT cctt FROM escuela) As lp
                                                    ON esc.cctt = lp.cctt ) As f ) As fc ;";

            $statement = $conn->query($consulta);
            $result = $statement->fetchAll();
            $conn->close();
            return $this->json($result[0]['row_to_json']);
        }

        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }

    /**
     * @Route("/colonias", name="maps_colonias",options={"expose"=true})
     */
    public function colonias(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $connectionParams = array(
                'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/Escuelav2?serverVersion=5.7',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            $conn->connect();

            $consulta = "SELECT row_to_json(fc)
                        FROM (
                            SELECT 'FeatureCollection'
                             As type, array_to_json(array_agg(f)) As features
                                    FROM (
                                        SELECT 'Feature' As type
                                        , ST_AsGeoJSON(col.geom)::json As geometry
                                        FROM colonia As col

                                        ) As f
                                 ) As fc  ;";

            $statement = $conn->query($consulta);
            $result = $statement->fetchAll();
            $conn->close();
            return $this->json($result[0]['row_to_json']);
        }

        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }

    /**
     * @Route("/calles", name="maps_calles",options={"expose"=true})
     */
    public function calles(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $connectionParams = array(
                'url' => 'pgsql://postgres:postgres@127.0.0.1:5432/Escuelav2?serverVersion=5.7',
            );
            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
            $conn->connect();

            $consulta = "SELECT row_to_json(fc)
                            FROM (
                                SELECT 'FeatureCollection'
                                 As type, array_to_json(array_agg(f)) As features
                                        FROM (
                                            SELECT 'Feature' As type
                                            , ST_AsGeoJSON(cal.geom)::json As geometry
                                            FROM calle As cal

                                            ) As f
                                 ) As fc  ;";

            $statement = $conn->query($consulta);
            $result = $statement->fetchAll();
            $conn->close();
            return $this->json($result[0]['row_to_json']);
        }

        return $this->render('maps/index.html.twig', [
            'controller_name' => 'MapsController',
        ]);
    }
}
