<?php

namespace App\Controller;

use App\Entity\DiagnosticoPlantel;
use App\Entity\Escuela;
use App\Entity\Estatus;
use App\Entity\PlanTrabajo;
use App\Entity\Proyecto;
use App\Entity\RendicionCuentas;
use App\Entity\ControlGastos;
use App\Form\FiltroType;
use App\Form\ProyectoType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/proyecto")
 */
class ProyectoController extends AbstractController
{
    /**
     * @Route("/", name="proyecto_index", methods={"GET","POST"})
     */
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $form=$this->createForm(FiltroType::class,[],['action'=>$this->generateUrl('proyecto_index')]);
        $form->handleRequest($request);

        $dql   = "SELECT p FROM App:Proyecto p";
        $data=$request->query->get('filtro');

        if ($form->isSubmitted() || $data!="") {
            if($form->isSubmitted())
                $data = $form->getData()["filtro"];
            $dql   = "SELECT p FROM App:Proyecto p JOIN p.escuela e WHERE e.escuela LIKE :value OR p.numero LIKE :value";
            $query = $this->getDoctrine()->getManager()->createQuery($dql)->setParameter('value',"%".$data."%");
        }
        else
            $query = $this->getDoctrine()->getManager()->createQuery($dql);

        $proyectos = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            $this->getParameter('knp_num_items_per_page') /*limit per page*/
        );

        return $this->render('proyecto/index.html.twig', [
            'proyectos' => $proyectos,
            'filtro'=>$data,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/findbyescuela", name="proyecto_findby_escuela", methods={"GET"})
     */
    public function findByEscuela(Escuela $escuela): Response
    {
        $proyectos = $this->getDoctrine()->getRepository(Proyecto::class)->findByEscuela($escuela);

        return $this->render('proyecto/findbyescuela.html.twig', [
            'proyectos' => $proyectos,
            'escuela' => $escuela,
        ]);
    }

    /**
     * @Route("/new", name="proyecto_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $proyecto = new Proyecto();
        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_new')]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($proyecto);
                $entityManager->flush();
                $this->addFlash('success','El proyecto fue registrado satisfactoriamente');
                return $this->json([
                    'url'=>$this->generateUrl('proyecto_index')
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'form' => $form->createView(),
                    'proyecto' => $proyecto,
                ]);
                return $this->json(['form' => $page, 'error' => true,]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="proyecto_show", methods={"GET"},options={"expose"=true})
     */
    public function show(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $gastos=$this->getDoctrine()->getRepository(Proyecto::class)->findSumaGastos($proyecto->getId());
        return $this->render('proyecto/show.html.twig', [
            'proyecto' => $proyecto,
            'montogastado' => $gastos,
            'saldofinal' => $proyecto->getMontoasignado()-$gastos,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="proyecto_edit", methods={"GET","POST"},options={"expose"=true})
     */
    public function edit(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_edit', ['id' => $proyecto->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($proyecto);
                $em->flush();
                $this->addFlash('success','El proyecto fue actualizado satisfactoriamente');
                return $this->json([
                    'url'=>$this->generateUrl('proyecto_index')
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'proyecto' => $proyecto,
                    'form' => $form->createView(),
                    'form_id' => 'proyecto_edit',
                    'action' => 'Actualizar',
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'title' => 'Editar proyecto',
            'action' => 'Actualizar',
            'form_id' => 'proyecto_edit',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="proyecto_delete")
     */
    public function delete(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest() || !$this->isCsrfTokenValid('delete' . $proyecto->getId(), $request->query->get('_token')))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $estatus=$this->getDoctrine()->getRepository(Estatus::class)->findOneByEstatus('Eliminado');
        if(!$estatus)
            throw new \Exception('No existe el estatus');
        $proyecto->setEstatus($estatus);
        $em->flush();
        $this->addFlash('success','El proyecto fue eliminado satisfactoriamente');
        return $this->json([
            'url'=>$this->generateUrl('proyecto_index')
        ]);
    }


}