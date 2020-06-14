<?php

namespace App\Controller;

use App\Entity\CondicionDocenteEducativa;
use App\Entity\CondicionEducativaAlumnos;
use App\Entity\Escuela;
use App\Entity\EscuelaCCTS;
use App\Form\EscuelaCCTSType;
use App\Twig\EstatusExtension;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/escuelaccts")
 */
class EscuelaCCTSController extends AbstractController
{

    /**
     * @Route("/{id}/new", name="escuela_ccts_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request,Escuela $escuela): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $escuelaccts = new EscuelaCCTS();
        $escuelaccts->setEscuela($escuela);
        $form = $this->createForm(EscuelaCCTSType::class, $escuelaccts, ['action' => $this->generateUrl('escuela_ccts_new',['id'=>$escuela->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($escuelaccts);
                $entityManager->flush();
                return $this->json(['mensaje' => 'La clave fue registrada satisfactoriamente',
                    'value' => $escuelaccts->getValue(),
                    'id' => $escuelaccts->getId(),
                ]);
            } else {
                $page = $this->renderView('escuela_ccts/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('escuela_ccts/new.html.twig', [
            'escuelaccts' => $escuelaccts,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="escuela_ccts_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, EscuelaCCTS $escuelaccts): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(EscuelaCCTSType::class, $escuelaccts, ['action' => $this->generateUrl('escuela_ccts_edit', ['id' => $escuelaccts->getId()])]);
        $form->handleRequest($request);

        $eliminable=$this->esEliminable($escuelaccts);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($escuelaccts);
                $em->flush();
                return $this->json(['mensaje' => 'La clave fue actualizado satisfactoriamente',
                    'value' => $escuelaccts->getValue(),
                ]);
            } else {
                $page = $this->renderView('escuela_ccts/_form.html.twig', [
                    'escuelaccts' => $escuelaccts,
                    'eliminable'=>$eliminable,
                    'form' => $form->createView(),
                    'form_id' => 'escuela_ccts_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('escuela_ccts/new.html.twig', [
            'escuelaccts' => $escuelaccts,
            'eliminable'=>$eliminable,
            'title' => 'Editar clave',
            'action' => 'Actualizar',
            'form_id' => 'escuela_ccts_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="escuela_ccts_delete")
     */
    public function delete(Request $request, EscuelaCCTS $escuelaccts): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $escuelaccts->getId(), $request->query->get('_token')) || false==$this->esEliminable($escuelaccts))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($escuelaccts);
        $em->flush();
        return $this->json(['mensaje' => 'La clave fue eliminada satisfactoriamente']);
    }

    private function esEliminable(EscuelaCCTS $escuelaccts)
    {
        $em = $this->getDoctrine()->getManager();
        $condicion_educativa_alumnos=$em->getRepository(CondicionEducativaAlumnos::class)->findOneByccts($escuelaccts);
        $condicion_docente_educativa=$em->getRepository(CondicionDocenteEducativa::class)->findOneByccts($escuelaccts);
        return $condicion_educativa_alumnos==null && $condicion_docente_educativa==null;
    }

}