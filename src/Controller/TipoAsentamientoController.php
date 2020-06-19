<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\TipoAsentamiento;
use App\Form\TipoAsentamientoType;
use App\Twig\EstatusExtension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/asentamiento")
 */
class TipoAsentamientoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_asentamiento_index", methods={"GET"})
     */
    public function index(): Response
    {
        $tipoasentamientos = $this->getDoctrine()->getRepository(TipoAsentamiento::class)->findAll();

        return $this->render('tipo_asentamiento/index.html.twig', [
            'tipo_asentamientos' => $tipoasentamientos,
        ]);
    }

    /**
     * @Route("/new", name="tipo_asentamiento_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $tipoasentamiento = new TipoAsentamiento();
        $form = $this->createForm(TipoAsentamientoType::class, $tipoasentamiento, ['action' => $this->generateUrl('tipo_asentamiento_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($tipoasentamiento);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El tipo de asentamiento fue registrado satisfactoriamente',
                    'nombre' => $tipoasentamiento->getNombre(),
                    'clave' => $tipoasentamiento->getClave(),
                    'id' => $tipoasentamiento->getId(),
                ]);
            } else {
                $page = $this->renderView('tipo_asentamiento/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('tipo_asentamiento/new.html.twig', [
            'tipoasentamiento' => $tipoasentamiento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_asentamiento_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, TipoAsentamiento $tipoasentamiento): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(TipoAsentamientoType::class, $tipoasentamiento, ['action' => $this->generateUrl('tipo_asentamiento_edit', ['id' => $tipoasentamiento->getId()])]);
        $form->handleRequest($request);

        $eliminable = $this->esEliminable($tipoasentamiento);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($tipoasentamiento);
                $em->flush();
                return $this->json(['mensaje' => 'El tipo de asentamiento fue actualizado satisfactoriamente',
                    'nombre' => $tipoasentamiento->getNombre(),
                    'clave' => $tipoasentamiento->getClave(),
                ]);
            } else {
                $page = $this->renderView('tipo_asentamiento/_form.html.twig', [
                    'tipoasentamiento' => $tipoasentamiento,
                    'eliminable' => $eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'tipo_asentamiento_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('tipo_asentamiento/new.html.twig', [
            'tipoasentamiento' => $tipoasentamiento,
            'eliminable' => $eliminable,
            'title' => 'Editar tipo de asentamiento',
            'action' => 'Actualizar',
            'form_id' => 'tipo_asentamiento_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="tipo_asentamiento_delete")
     */
    public function delete(Request $request, TipoAsentamiento $tipoasentamiento): Response
    {
        if (!$request->isXmlHttpRequest() ||
            !$this->isCsrfTokenValid('delete' . $tipoasentamiento->getId(),$request->query->get('_token'))
            || !$this->esEliminable($tipoasentamiento))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($tipoasentamiento);
        $em->flush();
        return $this->json(['mensaje' => 'El tipo de asentamiento fue eliminado satisfactoriamente']);
    }

    private function esEliminable(TipoAsentamiento $tipoAsentamiento)
    {
        $em = $this->getDoctrine()->getManager();
        $codigo_postal = $em->getRepository(CodigoPostal::class)->findOneByTipoasentamiento($tipoAsentamiento);
        return $codigo_postal == null;
    }
}