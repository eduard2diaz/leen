<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Form\EscuelaType;
use App\Repository\EscuelaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escuela")
 */
class EscuelaController extends AbstractController
{
    /**
     * @Route("/", name="escuela_index", methods={"GET"})
     */
    public function index(EscuelaRepository $escuelaRepository): Response
    {
        return $this->render('escuela/index.html.twig', [
            'escuelas' => $escuelaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="escuela_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $escuela = new Escuela();
        $form = $this->createForm(EscuelaType::class, $escuela);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($escuela);
            $entityManager->flush();

            return $this->redirectToRoute('escuela_index');
        }

        return $this->render('escuela/new.html.twig', [
            'escuela' => $escuela,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="escuela_show", methods={"GET"})
     */
    public function show(Escuela $escuela): Response
    {
        return $this->render('escuela/show.html.twig', [
            'escuela' => $escuela,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="escuela_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Escuela $escuela): Response
    {
        $form = $this->createForm(EscuelaType::class, $escuela);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('escuela_index');
        }

        return $this->render('escuela/edit.html.twig', [
            'escuela' => $escuela,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="escuela_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Escuela $escuela): Response
    {
        if ($this->isCsrfTokenValid('delete'.$escuela->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($escuela);
            $entityManager->flush();
        }

        return $this->redirectToRoute('escuela_index');
    }
}
