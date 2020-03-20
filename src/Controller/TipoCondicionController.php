<?php

namespace App\Controller;

use App\Entity\TipoCondicion;
use App\Form\TipoCondicionType;
use App\Repository\TipoCondicionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/condicion")
 */
class TipoCondicionController extends AbstractController
{
    /**
     * @Route("/", name="tipo_condicion_index", methods={"GET"})
     */
    public function index(TipoCondicionRepository $tipoCondicionRepository): Response
    {
        return $this->render('tipo_condicion/index.html.twig', [
            'tipo_condicions' => $tipoCondicionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_condicion_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoCondicion = new TipoCondicion();
        $form = $this->createForm(TipoCondicionType::class, $tipoCondicion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoCondicion);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_condicion_index');
        }

        return $this->render('tipo_condicion/new.html.twig', [
            'tipo_condicion' => $tipoCondicion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_condicion_show", methods={"GET"})
     */
    public function show(TipoCondicion $tipoCondicion): Response
    {
        return $this->render('tipo_condicion/show.html.twig', [
            'tipo_condicion' => $tipoCondicion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_condicion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoCondicion $tipoCondicion): Response
    {
        $form = $this->createForm(TipoCondicionType::class, $tipoCondicion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_condicion_index');
        }

        return $this->render('tipo_condicion/edit.html.twig', [
            'tipo_condicion' => $tipoCondicion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_condicion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoCondicion $tipoCondicion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoCondicion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoCondicion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_condicion_index');
    }
}
