<?php

namespace App\Controller;

use App\Entity\DiagnosticoPlantel;
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
                    'ffin' => $proyecto->getFechafin()->format('Y-m-d'),
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
     * @Route("/{id}/edit", name="proyecto_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_edit', ['id' => $proyecto->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($proyecto);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($proyecto);
                $em->flush();
                return $this->json(['mensaje' => 'El proyecto fue actualizado satisfactoriamente',
                    'escuela' => $proyecto->getEscuela()->__toString(),
                    'finicio' => $proyecto->getFechainicio()->format('Y-m-d'),
                    'ffin' => $proyecto->getFechafin()->format('Y-m-d'),
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'proyecto' => $proyecto,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'proyecto_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'eliminable'=>$eliminable,
            'title' => 'Editar proyecto',
            'action' => 'Actualizar',
            'form_id' => 'proyecto_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="proyecto_delete")
     */
    public function delete(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $proyecto->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($proyecto);
        $em->flush();
        return $this->json(['mensaje' => 'El proyecto fue eliminado satisfactoriamente']);
    }

    private function esEliminable(Proyecto $proyecto)
    {
        $em = $this->getDoctrine()->getManager();
        $rendicionCuenta=$em->getRepository(RendicionCuentas::class)->findOneByProyecto($proyecto);
        $diagnosticoPlantel=$em->getRepository(DiagnosticoPlantel::class)->findOneByProyecto($proyecto);
        $controlGasto=$em->getRepository(ControlGastos::class)->findOneByProyecto($proyecto);
        $planTrabajo=$em->getRepository(PlanTrabajo::class)->findOneByProyecto($proyecto);
        return $rendicionCuenta==null && $diagnosticoPlantel==null && $controlGasto==null  && $planTrabajo==null;
    }
}