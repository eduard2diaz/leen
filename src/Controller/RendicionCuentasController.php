<?php

namespace App\Controller;

use App\Entity\RendicionCuentas;
use App\Form\RendicionCuentasType;
use App\Repository\RendicionCuentasRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendicion/cuentas")
 */
class RendicionCuentasController extends AbstractController
{
    /**
     * @Route("/", name="rendicion_cuentas_index", methods={"GET"})
     */
    public function index(RendicionCuentasRepository $rendicionCuentasRepository): Response
    {
        return $this->render('rendicion_cuentas/index.html.twig', [
            'rendicion_cuentas' => $rendicionCuentasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rendicion_cuentas_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rendicionCuenta = new RendicionCuentas();
        $form = $this->createForm(RendicionCuentasType::class, $rendicionCuenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rendicionCuenta);
            $entityManager->flush();

            return $this->redirectToRoute('rendicion_cuentas_index');
        }

        return $this->render('rendicion_cuentas/new.html.twig', [
            'rendicion_cuenta' => $rendicionCuenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendicion_cuentas_show", methods={"GET"})
     */
    public function show(RendicionCuentas $rendicionCuenta): Response
    {
        return $this->render('rendicion_cuentas/show.html.twig', [
            'rendicion_cuenta' => $rendicionCuenta,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendicion_cuentas_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RendicionCuentas $rendicionCuenta): Response
    {
        $form = $this->createForm(RendicionCuentasType::class, $rendicionCuenta);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rendicion_cuentas_index');
        }

        return $this->render('rendicion_cuentas/edit.html.twig', [
            'rendicion_cuenta' => $rendicionCuenta,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rendicion_cuentas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RendicionCuentas $rendicionCuenta): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendicionCuenta->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendicionCuenta);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendicion_cuentas_index');
    }
}
