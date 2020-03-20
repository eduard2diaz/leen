<?php

namespace App\Controller;

use App\Entity\Estatus;
use App\Form\EstatusType;
use App\Repository\EstatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estatus")
 */
class EstatusController extends AbstractController
{
    /**
     * @Route("/", name="estatus_index", methods={"GET"})
     */
    public function index(EstatusRepository $estatusRepository): Response
    {
        return $this->render('estatus/index.html.twig', [
            'estatuses' => $estatusRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="estatus_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $estatus = new Estatus();
        $form = $this->createForm(EstatusType::class, $estatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($estatus);
            $entityManager->flush();

            return $this->redirectToRoute('estatus_index');
        }

        return $this->render('estatus/new.html.twig', [
            'estatus' => $estatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estatus_show", methods={"GET"})
     */
    public function show(Estatus $estatus): Response
    {
        return $this->render('estatus/show.html.twig', [
            'estatus' => $estatus,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estatus_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Estatus $estatus): Response
    {
        $form = $this->createForm(EstatusType::class, $estatus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estatus_index');
        }

        return $this->render('estatus/edit.html.twig', [
            'estatus' => $estatus,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="estatus_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Estatus $estatus): Response
    {
        if ($this->isCsrfTokenValid('delete'.$estatus->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($estatus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('estatus_index');
    }
}
