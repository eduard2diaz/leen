<?php

namespace App\Controller;

use App\Entity\TipoAccion;
use App\Form\TipoAccionType;
use App\Repository\TipoAccionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/accion")
 */
class TipoAccionController extends AbstractController
{
    /**
     * @Route("/", name="tipo_accion_index", methods={"GET"})
     */
    public function index(TipoAccionRepository $tipoAccionRepository): Response
    {
        return $this->render('tipo_accion/index.html.twig', [
            'tipo_accions' => $tipoAccionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_accion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoAccion = new TipoAccion();
        $form = $this->createForm(TipoAccionType::class, $tipoAccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoAccion);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_accion_index');
        }

        return $this->render('tipo_accion/new.html.twig', [
            'tipo_accion' => $tipoAccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_accion_show", methods={"GET"})
     */
    public function show(TipoAccion $tipoAccion): Response
    {
        return $this->render('tipo_accion/show.html.twig', [
            'tipo_accion' => $tipoAccion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_accion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoAccion $tipoAccion): Response
    {
        $form = $this->createForm(TipoAccionType::class, $tipoAccion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_accion_index');
        }

        return $this->render('tipo_accion/edit.html.twig', [
            'tipo_accion' => $tipoAccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_accion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoAccion $tipoAccion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoAccion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoAccion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_accion_index');
    }
}
