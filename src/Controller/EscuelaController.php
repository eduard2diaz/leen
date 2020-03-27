<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Proyecto;
use App\Form\EscuelaType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escuela")
 */
class EscuelaController extends AbstractController
{
    /**
     * @Route("/", name="escuela_index", methods={"GET"})
     */
    public function index(): Response
    {
        $escuelas = $this->getDoctrine()
            ->getRepository(Escuela::class)
            ->findAll();

        return $this->render('escuela/index.html.twig', [
            'escuelas' => $escuelas,
        ]);
    }

    /**
     * @Route("/new", name="escuela_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $escuela = new Escuela();
        $form = $this->createForm(EscuelaType::class, $escuela, ['action' => $this->generateUrl('escuela_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($escuela->getDCodigo());
                $entityManager->persist($escuela);
                $entityManager->flush();
                return $this->json(['mensaje' => 'La escuela fue registrada satisfactoriamente',
                    'escuela' => $escuela->getEscuela(),
                    'ccts' => $escuela->getCcts(),
                    'cp' => $escuela->getDCodigo()->__toString(),
                    'id' => $escuela->getId(),
                ]);
            } else {
                $page = $this->renderView('escuela/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('escuela/new.html.twig', [
            'escuela' => $escuela,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="escuela_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Escuela $escuela): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(EscuelaType::class, $escuela, ['action' => $this->generateUrl('escuela_edit', ['id' => $escuela->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($escuela);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($escuela);
                $em->flush();
                return $this->json(['mensaje' => 'La escuela fue actualizada satisfactoriamente',
                    'escuela' => $escuela->getEscuela(),
                    'ccts' => $escuela->getCcts(),
                    'cp' => $escuela->getDCodigo()->__toString(),
                    ]);
            } else {
                $page = $this->renderView('escuela/_form.html.twig', [

                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'escuela_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('escuela/new.html.twig', [
            'escuela' => $escuela,
            'eliminable'=>$eliminable,
            'title' => 'Editar escuela',
            'action' => 'Actualizar',
            'form_id' => 'escuela_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="escuela_delete")
     */
    public function delete(Request $request, Escuela $escuela): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $escuela->getId(), $request->query->get('_token')) ||  $this->esEliminable($escuela)==false)
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($escuela);
        $em->flush();
        return $this->json(['mensaje' => 'La escuela fue eliminada satisfactoriamente']);
    }

    private function esEliminable(Escuela $escuela)
    {
        $em = $this->getDoctrine()->getManager();
        $proyecto=$em->getRepository(Proyecto::class)->findOneByEscuela($escuela);
        return $proyecto==null;
    }


}