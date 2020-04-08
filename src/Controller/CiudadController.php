<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Ciudad;
use App\Form\CiudadType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ciudad")
 */
class CiudadController extends AbstractController
{
    /**
     * @Route("/", name="ciudad_index", methods={"GET"})
     */
    public function index(): Response
    {
        $ciudads = $this->getDoctrine()
            ->getRepository(Ciudad::class)
            ->findAll();

        return $this->render('ciudad/index.html.twig', [
            'ciudads' => $ciudads,
        ]);
    }

    /**
     * @Route("/new", name="ciudad_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $ciudad = new Ciudad();
        $form = $this->createForm(CiudadType::class, $ciudad, ['action' => $this->generateUrl('ciudad_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($ciudad);
                $entityManager->flush();
                return $this->json(['mensaje' => 'La ciudad fue registrada satisfactoriamente',
                    'nombre' => $ciudad->getNombre(),
                    'clave' => $ciudad->getClave(),
                    'estado' => $ciudad->getEstado()->getNombre(),
                    'municipio' => $ciudad->getMunicipio()->getNombre(),
                    'id' => $ciudad->getId(),
                ]);
            } else {
                $page = $this->renderView('ciudad/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('ciudad/new.html.twig', [
            'ciudad' => $ciudad,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ciudad_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Ciudad $ciudad): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(CiudadType::class, $ciudad, ['action' => $this->generateUrl('ciudad_edit', ['id' => $ciudad->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($ciudad);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ciudad);
                $em->flush();
                return $this->json(['mensaje' => 'La ciudad fue actualizada satisfactoriamente',
                    'nombre' => $ciudad->getNombre(),
                    'clave' => $ciudad->getClave(),
                    'estado' => $ciudad->getEstado()->getNombre(),
                    'municipio' => $ciudad->getMunicipio()->getNombre(),
                ]);
            } else {
                $page = $this->renderView('ciudad/_form.html.twig', [
                    'ciudad' => $ciudad,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'ciudad_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('ciudad/new.html.twig', [
            'ciudad' => $ciudad,
            'eliminable'=>$eliminable,
            'title' => 'Editar ciudad',
            'action' => 'Actualizar',
            'form_id' => 'ciudad_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ciudad_delete")
     */
    public function delete(Request $request, Ciudad $ciudad): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $ciudad->getId(), $request->query->get('_token')) || !$this->esEliminable($ciudad))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($ciudad);
        $em->flush();
        return $this->json(['mensaje' => 'La ciudad fue eliminada satisfactoriamente']);
    }

    private function esEliminable(Ciudad $ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad=$em->getRepository(CodigoPostal::class)->findOneByCiudad($ciudad);
        return $ciudad==null;
    }
}