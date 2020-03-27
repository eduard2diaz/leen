<?php

namespace App\Controller;

use App\Entity\CondicionEducativaAlumnos;
use App\Form\CondicionEducativaAlumnosType;
use App\Repository\CondicionEducativaAlumnosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/condicion/educativa/alumnos")
 */
class CondicionEducativaAlumnosController extends AbstractController
{
    /**
     * @Route("/", name="condicion_educativa_alumnos_index", methods={"GET"})
     */
    public function index(CondicionEducativaAlumnosRepository $condicionEducativaAlumnosRepository): Response
    {
        return $this->render('condicion_educativa_alumnos/index.html.twig', [
            'condicion_educativa_alumnos' => $condicionEducativaAlumnosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="condicion_educativa_alumnos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $condicionEducativaAlumno = new CondicionEducativaAlumnos();
        $form = $this->createForm(CondicionEducativaAlumnosType::class, $condicionEducativaAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($condicionEducativaAlumno);
            $entityManager->flush();

            return $this->redirectToRoute('condicion_educativa_alumnos_index');
        }

        return $this->render('condicion_educativa_alumnos/new.html.twig', [
            'condicion_educativa_alumno' => $condicionEducativaAlumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condicion_educativa_alumnos_show", methods={"GET"})
     */
    public function show(CondicionEducativaAlumnos $condicionEducativaAlumno): Response
    {
        return $this->render('condicion_educativa_alumnos/show.html.twig', [
            'condicion_educativa_alumno' => $condicionEducativaAlumno,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="condicion_educativa_alumnos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CondicionEducativaAlumnos $condicionEducativaAlumno): Response
    {
        $form = $this->createForm(CondicionEducativaAlumnosType::class, $condicionEducativaAlumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('condicion_educativa_alumnos_index');
        }

        return $this->render('condicion_educativa_alumnos/edit.html.twig', [
            'condicion_educativa_alumno' => $condicionEducativaAlumno,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="condicion_educativa_alumnos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CondicionEducativaAlumnos $condicionEducativaAlumno): Response
    {
        if ($this->isCsrfTokenValid('delete'.$condicionEducativaAlumno->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($condicionEducativaAlumno);
            $entityManager->flush();
        }

        return $this->redirectToRoute('condicion_educativa_alumnos_index');
    }
}
