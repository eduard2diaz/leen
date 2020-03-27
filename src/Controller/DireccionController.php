<?php

namespace App\Controller;

use App\Entity\Direccion;
use App\Form\DireccionType;
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
    public function index(): Response
    {
        $direccions = $this->getDoctrine()
            ->getRepository(Direccion::class)
            ->findAll();

        return $this->render('direccion/index.html.twig', [
            'direccions' => $direccions,
        ]);
    }

    /**
     * @Route("/new", name="direccion_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $direccion = new Direccion();
        $form = $this->createForm(DireccionType::class, $direccion, ['action' => $this->generateUrl('direccion_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($direccion);
                $entityManager->flush();
                return $this->json(['mensaje' => 'La dirección fue registrada satisfactoriamente',
                    'codigo' => $direccion->getDCodigo()->__toString(),
                    'noexterior' => $direccion->getNumeroExterior(),
                    'calle' => $direccion->getCalle(),
                    'id' => $direccion->getId(),
                ]);
            } else {
                $page = $this->renderView('direccion/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('direccion/new.html.twig', [
            'direccion' => $direccion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="direccion_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Direccion $direccion): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(DireccionType::class, $direccion, ['action' => $this->generateUrl('direccion_edit', ['id' => $direccion->getId()])]);
        $form->handleRequest($request);

        $eliminable=true;
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($direccion);
                $em->flush();
                return $this->json(['mensaje' => 'La dirección fue actualizada satisfactoriamente',
                ]);
            } else {
                $page = $this->renderView('direccion/_form.html.twig', [
                    'codigo' => $direccion->getDCodigo()->__toString(),
                    'noexterior' => $direccion->getNumeroExterior(),
                    'calle' => $direccion->getCalle(),
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'direccion_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('direccion/new.html.twig', [
            'direccion' => $direccion,
            'eliminable'=>$eliminable,
            'title' => 'Editar dirección',
            'action' => 'Actualizar',
            'form_id' => 'direccion_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="direccion_delete")
     */
    public function delete(Request $request, Direccion $direccion): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $direccion->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($direccion);
        $em->flush();
        return $this->json(['mensaje' => 'La dirección fue eliminada satisfactoriamente']);
    }
}