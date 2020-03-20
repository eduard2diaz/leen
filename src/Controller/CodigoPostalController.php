<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Form\CodigoPostalType;
use App\Repository\CodigoPostalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/codigo/postal")
 */
class CodigoPostalController extends AbstractController
{
    /**
     * @Route("/", name="codigo_postal_index", methods={"GET"})
     */
    public function index(CodigoPostalRepository $codigoPostalRepository): Response
    {
        return $this->render('codigo_postal/index.html.twig', [
            'codigo_postals' => $codigoPostalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="codigo_postal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $codigoPostal = new CodigoPostal();
        $form = $this->createForm(CodigoPostalType::class, $codigoPostal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($codigoPostal);
            $entityManager->flush();

            return $this->redirectToRoute('codigo_postal_index');
        }

        return $this->render('codigo_postal/new.html.twig', [
            'codigo_postal' => $codigoPostal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="codigo_postal_show", methods={"GET"})
     */
    public function show(CodigoPostal $codigoPostal): Response
    {
        return $this->render('codigo_postal/show.html.twig', [
            'codigo_postal' => $codigoPostal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="codigo_postal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CodigoPostal $codigoPostal): Response
    {
        $form = $this->createForm(CodigoPostalType::class, $codigoPostal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('codigo_postal_index');
        }

        return $this->render('codigo_postal/edit.html.twig', [
            'codigo_postal' => $codigoPostal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="codigo_postal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CodigoPostal $codigoPostal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$codigoPostal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($codigoPostal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('codigo_postal_index');
    }
}
