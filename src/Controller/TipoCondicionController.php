<?php

namespace App\Controller;

use App\Entity\Proyecto;
use App\Entity\TipoCondicion;
use App\Form\TipoCondicionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipocondicion")
 */
class TipoCondicionController extends AbstractController
{
    /**
     * @Route("/", name="tipo_condicion_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tipocondicions = $this->getDoctrine()
            ->getRepository(TipoCondicion::class)
            ->findAll();

        return $this->render('tipo_condicion/index.html.twig', [
            'tipo_condicions' => $tipocondicions,
        ]);
    }

    /**
     * @Route("/new", name="tipo_condicion_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $tipocondicion = new TipoCondicion();
        $form = $this->createForm(TipoCondicionType::class, $tipocondicion, ['action' => $this->generateUrl('tipo_condicion_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tipocondicion);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El tipo de condición fue registrado satisfactoriamente',
                    'condicion' => $tipocondicion->getCondicion(),
                    'id' => $tipocondicion->getId(),
                ]);
            } else {
                $page = $this->renderView('tipo_condicion/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('tipo_condicion/new.html.twig', [
            'tipocondicion' => $tipocondicion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_condicion_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, TipoCondicion $tipocondicion): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(TipoCondicionType::class, $tipocondicion, ['action' => $this->generateUrl('tipo_condicion_edit', ['id' => $tipocondicion->getId()])]);
        $form->handleRequest($request);

        $eliminable=true;
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tipocondicion);
                $em->flush();
                return $this->json(['mensaje' => 'El tipo de condición fue actualizado satisfactoriamente',
                    'condicion' => $tipocondicion->getCondicion(),
                ]);
            } else {
                $page = $this->renderView('tipo_condicion/_form.html.twig', [
                    'tipocondicion' => $tipocondicion,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'tipo_condicion_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('tipo_condicion/new.html.twig', [
            'tipocondicion' => $tipocondicion,
            'eliminable'=>$eliminable,
            'title' => 'Editar tipo de condición',
            'action' => 'Actualizar',
            'form_id' => 'tipo_condicion_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_condicion_delete")
     */
    public function delete(Request $request, TipoCondicion $tipocondicion): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $tipocondicion->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($tipocondicion);
        $em->flush();
        return $this->json(['mensaje' => 'El tipo de condición fue eliminado satisfactoriamente']);
    }
}