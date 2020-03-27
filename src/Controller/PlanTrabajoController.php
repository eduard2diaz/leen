<?php

namespace App\Controller;

use App\Entity\PlanTrabajo;
use App\Form\PlanTrabajoType;
use App\Repository\PlanTrabajoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plan/trabajo")
 */
class PlanTrabajoController extends AbstractController
{
    /**
     * @Route("/", name="plan_trabajo_index", methods={"GET"})
     */
    public function index(PlanTrabajoRepository $planTrabajoRepository): Response
    {
        return $this->render('plan_trabajo/index.html.twig', [
            'plan_trabajos' => $planTrabajoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="plan_trabajo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planTrabajo = new PlanTrabajo();
        $form = $this->createForm(PlanTrabajoType::class, $planTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planTrabajo);
            $entityManager->flush();

            return $this->redirectToRoute('plan_trabajo_index');
        }

        return $this->render('plan_trabajo/new.html.twig', [
            'plan_trabajo' => $planTrabajo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_trabajo_show", methods={"GET"})
     */
    public function show(PlanTrabajo $planTrabajo): Response
    {
        return $this->render('plan_trabajo/show.html.twig', [
            'plan_trabajo' => $planTrabajo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plan_trabajo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanTrabajo $planTrabajo): Response
    {
        $form = $this->createForm(PlanTrabajoType::class, $planTrabajo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plan_trabajo_index');
        }

        return $this->render('plan_trabajo/edit.html.twig', [
            'plan_trabajo' => $planTrabajo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_trabajo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanTrabajo $planTrabajo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planTrabajo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planTrabajo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plan_trabajo_index');
    }
}
