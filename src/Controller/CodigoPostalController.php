<?php

namespace App\Controller;

use App\Entity\CodigoPostal;
use App\Entity\Direccion;
use App\Entity\Escuela;
use App\Form\CodigoPostalType;
use App\Repository\CodigoPostalRepository;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/codigo/postal")
 */
class CodigoPostalController extends AbstractController
{
    /**
     * @Route("/", name="codigo_postal_index", methods={"GET"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $dql   = "SELECT cp FROM App:CodigoPostal cp";
        $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('codigo_postal/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="codigo_postal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $codigoPostal = new CodigoPostal();
        $form = $this->createForm(CodigoPostalType::class, $codigoPostal);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if(!$request->isXmlHttpRequest())
                throw $this->createAccessDeniedException();
            else
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($codigoPostal);
                $entityManager->flush();
                $this->addFlash('success','El código postal fue registrado satisfactoriamente');
                return $this->json(['url' => $this->generateUrl('codigo_postal_index',[],1)]);
            }
            else{
                $page = $this->renderView('codigo_postal/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('codigo_postal/new.html.twig', [
            'codigo_postal' => $codigoPostal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="codigo_postal_show", methods={"GET"})
     */
    public function show(Request $request, CodigoPostal $codigoPostal): Response
    {
        if(!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        return $this->render('codigo_postal/show.html.twig', [
            'codigo_postal' => $codigoPostal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="codigo_postal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CodigoPostal $codigoPostal): Response
    {
        $form = $this->createForm(CodigoPostalType::class, $codigoPostal);
        $form->handleRequest($request);
        $esEliminable=$this->esEliminable($codigoPostal);
        if ($form->isSubmitted())
            if(!$request->isXmlHttpRequest())
                throw $this->createAccessDeniedException();
            else
                if ($form->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();
                    $this->addFlash('success','El código postal fue actualizado satisfactoriamente');
                    return $this->json(['url' => $this->generateUrl('codigo_postal_index',[],1)]);
                }
                else{
                    $page = $this->renderView('codigo_postal/_form.html.twig', [
                        'action'=>'Actualizar',
                        'form' => $form->createView(),
                    ]);
                    return $this->json(['form' => $page, 'error' => true,]);
                }

        return $this->render('codigo_postal/edit.html.twig', [
            'codigo_postal' => $codigoPostal,
            'action'=>'Actualizar',
            'form' => $form->createView(),
            'eliminable'=>$esEliminable
        ]);
    }

    /**
     * @Route("/{id}/delete", name="codigo_postal_delete")
     */
    public function delete(Request $request, CodigoPostal $codigoPostal): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $codigoPostal->getId(), $request->query->get('_token')) || false==$this->esEliminable($codigoPostal))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($codigoPostal);
        $em->flush();
        $this->addFlash('success','El código postal fue eliminado satisfactoriamente');
        return $this->json(['url'=>$this->generateUrl('codigo_postal_index')]);
    }

    private function esEliminable(CodigoPostal $codigoPostal){
        $em = $this->getDoctrine()->getManager();
        $direccion=$em->getRepository(Direccion::class)->findOneBy(['d_codigo'=>$codigoPostal]);
        $escuela=$em->getRepository(Escuela::class)->findOneBy(['d_codigo'=>$codigoPostal]);
        return $direccion==null && $escuela==null;
    }
}
