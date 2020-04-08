<?php

namespace App\Controller;

use App\Entity\DiagnosticoPlantel;
use App\Entity\Escuela;
use App\Form\DiagnosticoPlantelType;
use App\Repository\DiagnosticoPlantelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Tool\FileStorageManager;

/**
 * @Route("/diagnostico/plantel")
 */
class DiagnosticoPlantelController extends AbstractController
{
    /**
     * @Route("/{id}/index", name="diagnostico_plantel_index", methods={"GET"})
     */
    public function index(Escuela $escuela): Response
    {
        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery('Select dp FROM App:DiagnosticoPlantel dp JOIN dp.proyecto p JOIN p.escuela e 
        WHERE e.id=:id')->setParameter('id', $escuela->getId());

        $diagnosticos = $consulta->getResult();
        return $this->render('diagnostico_plantel/index.html.twig', [
            'diagnosticos' => $diagnosticos,
            'escuela' => $escuela,
        ]);
    }

    /**
     * @Route("/{id}/new", name="diagnostico_plantel_new", methods={"GET","POST"})
     */
    public function new(Request $request, Escuela $escuela): Response
    {
        $diagnosticoPlantel = new DiagnosticoPlantel();
        $form = $this->createForm(DiagnosticoPlantelType::class, $diagnosticoPlantel);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if (!$request->isXmlHttpRequest())
                throw $this->createAccessDeniedException();
            else
                if ($form->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($diagnosticoPlantel);
                    $entityManager->flush();
                    $this->addFlash('success', 'El diagnóstico del plantel fue registrado satisfactoriamente');
                    return $this->json(['url' => $this->generateUrl('diagnostico_plantel_index', ['id' => $escuela->getId()], 1)]);
                } else {
                    $page = $this->renderView('diagnostico_plantel/_form.html.twig', [
                        'form' => $form->createView(),
                    ]);
                    return $this->json(['form' => $page, 'error' => true,]);
                }

        return $this->render('diagnostico_plantel/new.html.twig', [
            'diagnostico_plantel' => $diagnosticoPlantel,
            'escuela' => $escuela,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="diagnostico_plantel_show", methods={"GET"})
     */
    public function show(DiagnosticoPlantel $diagnosticoPlantel): Response
    {
        return $this->render('diagnostico_plantel/show.html.twig', [
            'diagnostico_plantel' => $diagnosticoPlantel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="diagnostico_plantel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, DiagnosticoPlantel $diagnosticoPlantel): Response
    {
        $form = $this->createForm(DiagnosticoPlantelType::class, $diagnosticoPlantel);
        $form->handleRequest($request);

        $escuela = $diagnosticoPlantel->getProyecto()->getEscuela();
        if ($form->isSubmitted())
            if (!$request->isXmlHttpRequest())
                throw $this->createAccessDeniedException();
            else
                if ($form->isValid()) {
                    $entityManager = $this->getDoctrine()->getManager();

                    if ($diagnosticoPlantel->getFile() != null) {
                        $ruta = $this->getParameter('storage_directory');
                        $rutaArchivo = $ruta . DIRECTORY_SEPARATOR . $diagnosticoPlantel->getDiagnosticoarchivo();
                        FileStorageManager::removeUpload($rutaArchivo);
                        $diagnosticoPlantel->setDiagnosticoarchivo(FileStorageManager::Upload($ruta, $diagnosticoPlantel->getFile()));
                        $diagnosticoPlantel->setFile(null);
                    }


                    $entityManager->persist($diagnosticoPlantel);
                    $entityManager->flush();
                    $this->addFlash('success', 'El diagnóstico del plantel fue actualizado satisfactoriamente');
                    return $this->json(['url' => $this->generateUrl('diagnostico_plantel_index', ['id' => $escuela->getId()], 1)]);
                } else {
                    $page = $this->renderView('diagnostico_plantel/_form.html.twig', [
                        'form' => $form->createView(),
                    ]);
                    return $this->json(['form' => $page, 'error' => true,]);
                }

        return $this->render('diagnostico_plantel/edit.html.twig', [
            'diagnostico_plantel' => $diagnosticoPlantel,
            'escuela' => $escuela,
            'action' => 'Actualizar',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="diagnostico_plantel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, DiagnosticoPlantel $diagnosticoPlantel): Response
    {
        if ($this->isCsrfTokenValid('delete' . $diagnosticoPlantel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($diagnosticoPlantel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('diagnostico_plantel_index');
    }

    /**
     * @Route("/{id}/descargar", name="diagnostico_plantel_descargar")
     */
    public function descargar(DiagnosticoPlantel $diagnosticoPlantel): Response
    {
        $ruta = $this->getParameter('storage_directory') . DIRECTORY_SEPARATOR . $diagnosticoPlantel->getDiagnosticoarchivo();
        return FileStorageManager::Download($ruta);
    }


}
