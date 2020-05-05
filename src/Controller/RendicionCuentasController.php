<?php

namespace App\Controller;

use App\Entity\Escuela;
use App\Entity\RendicionCuentas;
use App\Form\RendicionCuentasType;
use App\Repository\RendicionCuentasRepository;
use App\Tool\FileStorageManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rendicion/cuentas")
 */
class RendicionCuentasController extends AbstractController
{
    /**
     * @Route("/{id}/index", name="rendicion_cuentas_index", methods={"GET"})
     */
    public function index(Escuela $escuela): Response
    {
        $em=$this->getDoctrine()->getManager();
        $consulta = $em->createQuery('Select rc FROM App:RendicionCuentas rc JOIN rc.proyecto p JOIN p.escuela e 
        WHERE e.id=:id')->setParameter('id', $escuela->getId());
        $rendiciones=$consulta->getResult();

        return $this->render('rendicion_cuentas/index.html.twig', [
            'rendicion_cuentas' => $rendiciones,
            'escuela' => $escuela,
        ]);
    }

    /**
     * @Route("/{id}/new", name="rendicion_cuentas_new", methods={"GET","POST"})
     */
    public function new(Escuela $escuela, Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $controlgasto = new RendicionCuentas();
        $form = $this->createForm(RendicionCuentasType::class, $controlgasto, ['action' => $this->generateUrl('rendicion_cuentas_new',['id'=>$escuela->getId()]),'escuela'=>$escuela->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($controlgasto);
                $entityManager->flush();
                return $this->json(['mensaje' => 'La rendición de cuentas fue registrada satisfactoriamente',
                    'proyecto' => $controlgasto->getProyecto()->__toString(),
                    'tipoaccion' => $controlgasto->getTipoAccion()->__toString(),
                    'fecha' => $controlgasto->getFechacaptura()->format('Y-m-d'),
                    'id' => $controlgasto->getId(),
                ]);
            } else {
                $page = $this->renderView('rendicion_cuentas/_form.html.twig', [
                    'form' => $form->createView(),
                ]);
                return $this->json(['rendicion_cuentas' => $page, 'error' => true,]);
            }

        return $this->render('rendicion_cuentas/new.html.twig', [
            'rendicion_cuentas' => $controlgasto,
            'escuela' => $escuela,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="rendicion_cuentas_show", methods={"GET"}, options={"expose"=true})
     */
    public function show(RendicionCuentas $rendicioncuentas, Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        return $this->render('rendicion_cuentas/show.html.twig', [
            'rendicion_cuentas' => $rendicioncuentas,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rendicion_cuentas_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, RendicionCuentas $rendicioncuentas): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(RendicionCuentasType::class, $rendicioncuentas, ['action' => $this->generateUrl('rendicion_cuentas_edit', ['id' => $rendicioncuentas->getId()]),'escuela'=>$rendicioncuentas->getProyecto()->getEscuela()->getId()]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                if ($rendicioncuentas->getFile() != null) {
                    $ruta = $this->getParameter('storage_directory');
                    $rutaArchivo = $ruta . DIRECTORY_SEPARATOR . $rendicioncuentas->getRendicionesarchivos();
                    FileStorageManager::removeUpload($rutaArchivo);
                    $rendicioncuentas->setRendicionesarchivos(FileStorageManager::Upload($ruta, $rendicioncuentas->getFile()));
                    $rendicioncuentas->setFile(null);
                }

                $em->persist($rendicioncuentas);
                $em->flush();
                return $this->json(['mensaje' => 'La rendición de cuentas fue actualizada satisfactoriamente',
                    'proyecto' => $rendicioncuentas->getProyecto()->__toString(),
                    'tipoaccion' => $rendicioncuentas->getTipoAccion()->__toString(),
                    'fecha' => $rendicioncuentas->getFechacaptura()->format('Y-m-d'),
                ]);
            } else {
                $page = $this->renderView('rendicion_cuentas/_form.html.twig', [
                    'rendicion_cuentas' => $rendicioncuentas,
                    'form' => $form->createView(),
                    'form_id' => 'rendicion_cuentas_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('rendicion_cuentas/new.html.twig', [
            'rendicion_cuentas' => $rendicioncuentas,
            'title' => 'Editar rendición de cuentas',
            'action' => 'Actualizar',
            'form_id' => 'rendicion_cuentas_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="rendicion_cuentas_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RendicionCuentas $rendicioncuentas): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendicioncuentas->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rendicioncuentas);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rendicion_cuentas_index');
    }

    /**
     * @Route("/{id}/descargar", name="rendicion_cuentas_descargar")
     */
    public function descargar(RendicionCuentas $rendicioncuentas): Response
    {
        $ruta = $this->getParameter('storage_directory') . DIRECTORY_SEPARATOR . $rendicioncuentas->getRendicionesarchivos();
        return FileStorageManager::Download($ruta);
    }
}
