<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Municipio;
use App\Entity\Estado;
use App\Entity\Ciudad;
use App\Form\MunicipioType;
use Knp\Component\Pager\PaginatorInterface;
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
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT m FROM App:Municipio m";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $municipios = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

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
                $this->addFlash('success','El municipio fue registrado satisfactoriamente');
                return $this->json(['url' => $this->generateUrl('municipio_index')
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
     * @Route("/{id}/findbyestado", name="municipio_find_by_estado", methods={"GET"},options={"expose"=true})
     */
    public function findByEstado(Request $request, Estado $estado): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $municipio=$em->getRepository(Municipio::class)->findByEstado($estado);

        $municipio_array=[];
        foreach ($municipio as $obj)
            $municipio_array[]=['id'=>$obj->getId(),'nombre'=>$obj->getNombre()];

        return $this->json($municipio_array);
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
                $this->addFlash('success','El municipio fue actualizado satisfactoriamente');
                return $this->json(['url' => $this->generateUrl('municipio_index')]);
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
        $this->addFlash('success','El municipio fue eliminado satisfactoriamente');
        return $this->json([
            'url' => $this->generateUrl('municipio_index')
        ]);
    }

    private function esEliminable(Municipio $municipio)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad=$em->getRepository(Ciudad::class)->findOneByMunicipio($municipio);
        $codigospostales=$em->getRepository(CodigoPostal::class)->findOneByMunicipio($municipio);
        return $ciudad==null && $codigospostales==null;
    }
}