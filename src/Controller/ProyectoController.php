<?php

namespace App\Controller;

use App\Entity\DiagnosticoPlantel;
use App\Entity\Escuela;
use App\Entity\Estatus;
use App\Entity\PlanTrabajo;
use App\Entity\Proyecto;
use App\Entity\RendicionCuentas;
use App\Entity\ControlGastos;
use App\Form\ProyectoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto")
 */
class ProyectoController extends AbstractController
{
    /**
     * @Route("/", name="proyecto_index", methods={"GET"})
     */
    public function index(): Response
    {
        $proyectos = $this->getDoctrine()
            ->getRepository(Proyecto::class)
            ->findAll();

        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectos,
        ]);
    }


    /**
     * @Route("/{id}/findbyescuela", name="proyecto_findby_escuela", methods={"GET"})
     */
    public function findByEscuela(Escuela $escuela): Response
    {
        $proyectos = $this->getDoctrine()->getRepository(Proyecto::class)->findByEscuela($escuela);

        return $this->render('proyecto/findbyescuela.html.twig', [
            'proyectos' => $proyectos,
            'escuela' => $escuela,
        ]);
    }

    /**
     * @Route("/new", name="proyecto_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $proyecto = new Proyecto();
        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($proyecto);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El proyecto fue registrado satisfactoriamente',
                    'escuela' => $proyecto->getEscuela()->__toString(),
                    'finicio' => $proyecto->getFechainicio()->format('Y-m-d'),
                    'numero' => $proyecto->getNumero(),
                    'id' => $proyecto->getId(),
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="proyecto_show", methods={"GET"},options={"expose"=true})
     */
    public function show(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        return $this->render('proyecto/show.html.twig', [
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proyecto_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_edit', ['id' => $proyecto->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($proyecto);
                $em->flush();
                return $this->json(['mensaje' => 'El proyecto fue actualizado satisfactoriamente',
                    'escuela' => $proyecto->getEscuela()->__toString(),
                    'finicio' => $proyecto->getFechainicio()->format('Y-m-d'),
                    'numero' => $proyecto->getNumero(),
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'proyecto' => $proyecto,
                    'form' => $form->createView(),
                    'form_id' => 'proyecto_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'title' => 'Editar proyecto',
            'action' => 'Actualizar',
            'form_id' => 'proyecto_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="proyecto_delete")
     */
    public function delete(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $proyecto->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $estatus=$this->getDoctrine()->getRepository(Estatus::class)->findOneByEstatus('Eliminado');
        if(!$estatus)
            throw new \Exception('No existe el estatus');
        $proyecto->setEstatus($estatus);
        $em->flush();
        return $this->json(['mensaje' => 'El proyecto fue eliminado satisfactoriamente']);
    }


}