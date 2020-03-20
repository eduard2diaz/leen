<?php

namespace App\Controller;

use App\Entity\ControlGastos;
use App\Form\ControlGastosType;
use App\Repository\ControlGastosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/control/gastos")
 */
class ControlGastosController extends AbstractController
{
    /**
     * @Route("/", name="control_gastos_index", methods={"GET"})
     */
    public function index(ControlGastosRepository $controlGastosRepository): Response
    {
        return $this->render('control_gastos/index.html.twig', [
            'control_gastos' => $controlGastosRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="control_gastos_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $controlGasto = new ControlGastos();
        $form = $this->createForm(ControlGastosType::class, $controlGasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($controlGasto);
            $entityManager->flush();

            return $this->redirectToRoute('control_gastos_index');
        }

        return $this->render('control_gastos/new.html.twig', [
            'control_gasto' => $controlGasto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="control_gastos_show", methods={"GET"})
     */
    public function show(ControlGastos $controlGasto): Response
    {
        return $this->render('control_gastos/show.html.twig', [
            'control_gasto' => $controlGasto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="control_gastos_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ControlGastos $controlGasto): Response
    {
        $form = $this->createForm(ControlGastosType::class, $controlGasto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('control_gastos_index');
        }

        return $this->render('control_gastos/edit.html.twig', [
            'control_gasto' => $controlGasto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="control_gastos_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ControlGastos $controlGasto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$controlGasto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($controlGasto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('control_gastos_index');
    }
}
