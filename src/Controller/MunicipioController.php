<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Municipio;
use App\Form\MunicipioType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/municipio")
 */
class MunicipioController extends AbstractController
{
    /**
     * @Route("/", name="municipio_index", methods={"GET"})
     */
    public function index(): Response
    {
        $municipios = $this->getDoctrine()
            ->getRepository(Municipio::class)
            ->findAll();

        return $this->render('municipio/index.html.twig', [
            'municipios' => $municipios,
        ]);
    }

    /**
     * @Route("/new", name="municipio_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $municipio = new Municipio();
        $form = $this->createForm(MunicipioType::class, $municipio, ['action' => $this->generateUrl('municipio_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($municipio);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El municipio fue registrado satisfactoriamente',
                    'nombre' => $municipio->getNombre(),
                    'clave' => $municipio->getClave(),
                    'estado' => $municipio->getEstado()->getNombre(),
                    'id' => $municipio->getId(),
                ]);
            } else {
                $page = $this->renderView('municipio/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('municipio/new.html.twig', [
            'municipio' => $municipio,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="municipio_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Municipio $municipio): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(MunicipioType::class, $municipio, ['action' => $this->generateUrl('municipio_edit', ['id' => $municipio->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($municipio);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($municipio);
                $em->flush();
                return $this->json(['mensaje' => 'El municipio fue actualizado satisfactoriamente',
                    'nombre' => $municipio->getNombre(),
                    'clave' => $municipio->getClave(),
                    'estado' => $municipio->getEstado()->getNombre(),
                ]);
            } else {
                $page = $this->renderView('municipio/_form.html.twig', [
                    'municipio' => $municipio,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'municipio_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('municipio/new.html.twig', [
            'municipio' => $municipio,
            'eliminable'=>$eliminable,
            'title' => 'Editar municipio',
            'action' => 'Actualizar',
            'form_id' => 'municipio_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="municipio_delete")
     */
    public function delete(Request $request, Municipio $municipio): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $municipio->getId(), $request->query->get('_token')) || !$this->esEliminable($municipio))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($municipio);
        $em->flush();
        return $this->json(['mensaje' => 'El municipio fue eliminado satisfactoriamente']);
    }

    private function esEliminable(Municipio $municipio)
    {
        $em = $this->getDoctrine()->getManager();
        $municipio=$em->getRepository(Ciudad::class)->findOneByMunicipio($municipio);
        return $municipio==null;
    }
}