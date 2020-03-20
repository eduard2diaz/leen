<?php

namespace App\Controller;

use App\Entity\Direccion;
use App\Form\DireccionType;
use App\Repository\DireccionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/direccion")
 */
class DireccionController extends AbstractController
{
    /**
     * @Route("/", name="direccion_index", methods={"GET"})
     */
    public function index(DireccionRepository $direccionRepository): Response
    {
        return $this->render('direccion/index.html.twig', [
            'direccions' => $direccionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="direccion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $direccion = new Direccion();
        $form = $this->createForm(DireccionType::class, $direccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($direccion);
            $entityManager->flush();

            return $this->redirectToRoute('direccion_index');
        }

        return $this->render('direccion/new.html.twig', [
            'direccion' => $direccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="direccion_show", methods={"GET"})
     */
    public function show(Direccion $direccion): Response
    {
        return $this->render('direccion/show.html.twig', [
            'direccion' => $direccion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="direccion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Direccion $direccion): Response
    {
        $form = $this->createForm(DireccionType::class, $direccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('direccion_index');
        }

        return $this->render('direccion/edit.html.twig', [
            'direccion' => $direccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="direccion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Direccion $direccion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$direccion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($direccion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('direccion_index');
    }
}
