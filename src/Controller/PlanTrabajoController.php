<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\Estatus;
use App\Entity\PlanTrabajo;
use App\Entity\Proyecto;
use App\Form\PlanTrabajoType;
use App\Repository\PlanTrabajoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Tool\FileStorageManager;

/**
 * @Route("/plantrabajo")
 */
class PlanTrabajoController extends AbstractController
{
    /**
     * @Route("/{id}/index", name="plan_trabajo_index", methods={"GET"})
     */
    public function index(Proyecto $proyecto): Response
    {
        $em=$this->getDoctrine()->getManager();
        $planTrabajos=$em->getRepository(PlanTrabajo::class)->findByProyecto($proyecto);

        return $this->render('plan_trabajo/index.html.twig', [
            'plan_trabajos' => $planTrabajos,
            'proyecto' => $proyecto,
        ]);
    }

    /**
     * @Route("/{id}/new", name="plan_trabajo_new", methods={"GET","POST"})
     */
    public function new(Proyecto $proyecto, Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $planTrabajo = new PlanTrabajo();
        $planTrabajo->setProyecto($proyecto);
        $form = $this->createForm(PlanTrabajoType::class, $planTrabajo, ['action' => $this->generateUrl('plan_trabajo_new',['id'=>$proyecto->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($planTrabajo);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El plan de trabajo fue registrado satisfactoriamente',
                    'tipoaccion' => $planTrabajo->getTipoAccion()->__toString(),
                    'fecha' => $planTrabajo->getFechacaptura()->format('Y-m-d'),
                    'id' => $planTrabajo->getId(),
                ]);
            } else {
                $page = $this->renderView('plan_trabajo/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['plan_trabajo' => $page, 'error' => true,]);
            }

        return $this->render('plan_trabajo/new.html.twig', [
            'plan_trabajo' => $planTrabajo,
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="plan_trabajo_show", methods={"GET"}, options={"expose"=true})
     */
    public function show(PlanTrabajo $planTrabajo, Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        return $this->render('plan_trabajo/show.html.twig', [
            'plan_trabajo' => $planTrabajo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plan_trabajo_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, PlanTrabajo $planTrabajo): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(PlanTrabajoType::class, $planTrabajo, ['action' => $this->generateUrl('plan_trabajo_edit', ['id' => $planTrabajo->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                if ($planTrabajo->getFile() != null) {
                    $ruta = $this->getParameter('storage_directory');
                    $rutaArchivo = $ruta . DIRECTORY_SEPARATOR . $planTrabajo->getPlanarchivo();
                    FileStorageManager::removeUpload($rutaArchivo);
                    $planTrabajo->setPlanarchivo(FileStorageManager::Upload($ruta, $planTrabajo->getFile()));
                    $planTrabajo->setFile(null);
                }
                
                $em->persist($planTrabajo);
                $em->flush();
                return $this->json(['mensaje' => 'El plan de trabajo fue actualizado satisfactoriamente',
                    'tipoaccion' => $planTrabajo->getTipoAccion()->__toString(),
                    'fecha' => $planTrabajo->getFechacaptura()->format('Y-m-d'),
                ]);
            } else {
                $page = $this->renderView('plan_trabajo/_form.html.twig', [
                    'plan_trabajo' => $planTrabajo,
                    'form' => $form->createView(),
                    'form_id' => 'plan_trabajo_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('plan_trabajo/new.html.twig', [
            'plan_trabajo' => $planTrabajo,
            'title' => 'Editar plan de trabajo',
            'action' => 'Actualizar',
            'form_id' => 'plan_trabajo_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="plan_trabajo_delete")
     */
    public function delete(Request $request, PlanTrabajo $planTrabajo): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $planTrabajo->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $em->remove($planTrabajo);
        $em->flush();
        return $this->json(['mensaje' => 'El diagnóstico de plantel fue eliminado satisfactoriamente']);
    }

    /**
     * @Route("/{id}/descargar", name="plan_trabajo_descargar")
     */
    public function descargar(PlanTrabajo $plantrabajo): Response
    {
        $ruta = $this->getParameter('storage_directory') . DIRECTORY_SEPARATOR . $plantrabajo->getPlanarchivo();
        return FileStorageManager::Download($ruta);
    }
}
