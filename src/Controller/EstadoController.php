<?php

namespace App\Controller;

use App\Entity\Estado;
use App\Entity\Municipio;
use App\Form\EstadoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/estado")
 */
class EstadoController extends AbstractController
{
    /**
     * @Route("/", name="estado_index", methods={"GET"})
     */
    public function index(): Response
    {
        $estados = $this->getDoctrine()->getRepository(Estado::class)->findAll();

        return $this->render('estado/index.html.twig', [
            'estados' => $estados,
        ]);
    }

    /**
     * @Route("/new", name="estado_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $estado = new Estado();
        $form = $this->createForm(EstadoType::class, $estado, ['action' => $this->generateUrl('estado_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($estado);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El estado fue registrado satisfactoriamente',
                    'nombre' => $estado->getNombre(),
                    'clave' => $estado->getClave(),
                    'estatus' => $estado->getEstatus()->getEstatus(),
                    'id' => $estado->getId(),
                ]);
            } else {
                $page = $this->renderView('estado/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('estado/new.html.twig', [
            'estado' => $estado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="estado_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Estado $estado): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(EstadoType::class, $estado, ['action' => $this->generateUrl('estado_edit', ['id' => $estado->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($estado);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($estado);
                $em->flush();
                return $this->json(['mensaje' => 'El estado fue actualizado satisfactoriamente',
                    'nombre' => $estado->getNombre(),
                    'clave' => $estado->getClave(),
                    'estatus' => $estado->getEstatus()->getEstatus(),
                ]);
            } else {
                $page = $this->renderView('estado/_form.html.twig', [
                    'estado' => $estado,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'estado_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('estado/new.html.twig', [
            'estado' => $estado,
            'eliminable'=>$eliminable,
            'title' => 'Editar estado',
            'action' => 'Actualizar',
            'form_id' => 'estado_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="estado_delete")
     */
    public function delete(Request $request, Estado $estado): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $estado->getId(), $request->query->get('_token')) || !$this->esEliminable($estado))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($estado);
        $em->flush();
        return $this->json(['mensaje' => 'El estado fue eliminado satisfactoriamente']);
    }

    private function esEliminable(Estado $estado)
    {
        $em = $this->getDoctrine()->getManager();
        $municipio=$em->getRepository(Municipio::class)->findOneByEstado($estado);
        return $municipio==null;
    }
}