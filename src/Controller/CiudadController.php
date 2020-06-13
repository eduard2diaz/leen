<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Ciudad;
use App\Entity\Municipio;
use App\Form\CiudadType;
use App\Form\FiltroType;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/", name="ciudad_index", methods={"GET","POST"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $form=$this->createForm(FiltroType::class,[],['action'=>$this->generateUrl('ciudad_index')]);
        $form->handleRequest($request);

        $dql   = "SELECT c FROM App:Ciudad c";
        $data=$request->query->get('filtro');

        if ($form->isSubmitted() || $data!="") {
            if($form->isSubmitted())
                $data = $form->getData()["filtro"];
            $dql   = "SELECT c FROM App:Ciudad c JOIN c.municipio m JOIN m.estado e WHERE c.nombre LIKE :value OR m.nombre LIKE :value OR e.nombre LIKE :value";
            $query = $this->getDoctrine()->getManager()->createQuery($dql)->setParameter('value',"%".$data."%");
        }
        else
            $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $ciudads = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $this->getParameter('knp_num_items_per_page') /*limit per page*/
        );

        return $this->render('ciudad/index.html.twig', [
            'ciudads' => $ciudads,
            'filtro'=>$data,
            'form' => $form->createView(),
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
                $this->addFlash('success','La ciudad fue registrada satisfactoriamente');
                return $this->json(['url' => $this->generateUrl('ciudad_index')]);
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
     * @Route("/{id}/findbymunicipio", name="ciudad_find_by_municipio", methods={"GET"},options={"expose"=true})
     */
    public function findByMunicipio(Request $request, Municipio $municipio): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $ciudad_array=$em->getRepository(Ciudad::class)->findByMunicipioJson($municipio->getId());

        return $this->json($ciudad_array);
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
                $this->addFlash('success','La ciudad fue actualizada satisfactoriamente');
                return $this->json(['url' => $this->generateUrl('ciudad_index')]);
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
     * @Route("/{id}/show", name="ciudad_show", methods={"GET"})
     */
    public function show(Request $request, Ciudad $ciudad): Response
    {
        if(!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        return $this->render('ciudad/show.html.twig', [
            'ciudad' => $ciudad,
        ]);
    }

    /**
     * @Route("/{id}/delete", name="ciudad_delete")
     */
    public function delete(Request $request, Ciudad $ciudad): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $ciudad->getId(), $request->query->get('_token')) || !$this->esEliminable($ciudad))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($ciudad);
        $em->flush();
        $this->addFlash('success','La ciudad fue eliminada satisfactoriamente');
        return $this->json(['url' => $this->generateUrl('ciudad_index')]);
    }

    private function esEliminable(Ciudad $ciudad)
    {
        $em = $this->getDoctrine()->getManager();
        $ciudad=$em->getRepository(CodigoPostal::class)->findOneByCiudad($ciudad);
        return $ciudad==null;
    }
}