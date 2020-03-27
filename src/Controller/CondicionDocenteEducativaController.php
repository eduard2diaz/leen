<?php

namespace App\Controller;

use App\Entity\CondicionDocenteEducativa;
use App\Form\CondicionDocenteEducativaType;
use App\Repository\CondicionDocenteEducativaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/condicion/docente/educativa")
 */
class CondicionDocenteEducativaController extends AbstractController
{
    /**
     * @Route("/", name="condicion_docente_educativa_index", methods={"GET"})
     */
    public function index(CondicionDocenteEducativaRepository $condicionDocenteEducativaRepository): Response
    {
        return $this->render('condicion_docente_educativa/index.html.twig', [
            'condicion_docente_educativas' => $condicionDocenteEducativaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="condicion_docente_educativa_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $condicionDocenteEducativa = new CondicionDocenteEducativa();
        $form = $this->createForm(CondicionDocenteEducativaType::class, $condicionDocenteEducativa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($condicionDocenteEducativa);
            $entityManager->flush();

            return $this->redirectToRoute('condicion_docente_educativa_index');
        }

        return $this->render('condicion_docente_educativa/new.html.twig', [
            'condicion_docente_educativa' => $condicionDocenteEducativa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condicion_docente_educativa_show", methods={"GET"})
     */
    public function show(CondicionDocenteEducativa $condicionDocenteEducativa): Response
    {
        return $this->render('condicion_docente_educativa/show.html.twig', [
            'condicion_docente_educativa' => $condicionDocenteEducativa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="condicion_docente_educativa_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CondicionDocenteEducativa $condicionDocenteEducativa): Response
    {
        $form = $this->createForm(CondicionDocenteEducativaType::class, $condicionDocenteEducativa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('condicion_docente_educativa_index');
        }

        return $this->render('condicion_docente_educativa/edit.html.twig', [
            'condicion_docente_educativa' => $condicionDocenteEducativa,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condicion_docente_educativa_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CondicionDocenteEducativa $condicionDocenteEducativa): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condicionDocenteEducativa->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condicionDocenteEducativa);
            $entityManager->flush();
        }

        return $this->redirectToRoute('condicion_docente_educativa_index');
    }
}
