<?php

namespace App\Controller;

use App\Entity\DiagnosticoPlantel;
use App\Entity\Escuela;
use App\Entity\Estatus;
use App\Entity\Plantel;
use App\Entity\PlanTrabajo;
use App\Entity\Proyecto;
use App\Entity\RendicionCuentas;
use App\Entity\ControlGastos;
use App\Form\FiltroType;
use App\Form\ProyectoType;
use App\Twig\EstatusExtension;
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
            $dql   = "SELECT p FROM App:Proyecto p JOIN p.plantel e WHERE (e.nombre LIKE :value OR p.numero LIKE :value)";
            $query = $this->getDoctrine()->getManager()->createQuery($dql);
            $query->setParameter('value',"%".$data."%");
        }
        else{
            $query = $this->getDoctrine()->getManager()->createQuery($dql);
        }

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
     * @Route("/{id}/findbyplantel", name="proyecto_findby_plantel", methods={"GET"})
     */
    public function findByPlantel(Plantel $plantel): Response
    {
        $proyectos = $this->getDoctrine()->getRepository(Proyecto::class)->findByPlantel($plantel);

        return $this->render('proyecto/findbyplantel.html.twig', [
            'proyectos' => $proyectos,
            'plantel' => $plantel,
        ]);
    }

    /**
     * @Route("/{id}/new", name="proyecto_new", methods={"GET","POST"},options={"expose"=true})
     */
    public function new(Request $request,Plantel $plantel): Response
    {
        if (!$request->isXmlHttpRequest())
            throw $this->createAccessDeniedException();

        $proyecto = new Proyecto();
        $proyecto->setPlantel($plantel);
        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_new',['id'=>$plantel->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($proyecto);
                $entityManager->flush();
                return $this->json(['mensaje' => 'El proyecto fue registrado satisfactoriamente',
                    'id' => $proyecto->getId(),
                    'numero' => $proyecto->getNumero(),
                    'fechainicio' => $proyecto->getFechainicio()->format('Y-m-d'),
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

        $eliminable=$this->esEliminable($proyecto);
        $form = $this->createForm(ProyectoType::class, $proyecto, ['action' => $this->generateUrl('proyecto_edit', ['id' => $proyecto->getId()])]);
        $form->handleRequest($request);

        if ($form->isSubmitted())
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($proyecto);
                $em->flush();
                return $this->json(['mensaje' => 'El tipo de asentamiento fue actualizado satisfactoriamente',
                    'numero' => $proyecto->getNumero(),
                    'fechainicio' => $proyecto->getFechainicio()->format('Y-m-d'),
                ]);
            } else {
                $page = $this->renderView('proyecto/_form.html.twig', [
                    'proyecto' => $proyecto,
                    'form' => $form->createView(),
                    'form_id' => 'proyecto_edit',
                    'action' => 'Actualizar',
                    'eliminable' => $eliminable,
                ]);
                return $this->json(['form' => $page, 'error' => true]);
            }

        return $this->render('proyecto/new.html.twig', [
            'proyecto' => $proyecto,
            'title' => 'Editar proyecto',
            'action' => 'Actualizar',
            'form_id' => 'proyecto_edit',
            'eliminable' => $eliminable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="proyecto_delete")
     */
    public function delete(Request $request, Proyecto $proyecto): Response
    {
        if (!$request->isXmlHttpRequest() ||
            !$this->isCsrfTokenValid('delete' . $proyecto->getId(), $request->query->get('_token'))
            || !$this->esEliminable($proyecto))
            throw $this->createAccessDeniedException();

        $plantel_id=$proyecto->getPlantel()->getId();
        $em = $this->getDoctrine()->getManager();
        $em->remove($proyecto);
        $em->flush();
        $this->addFlash('success','El proyecto fue eliminado satisfactoriamente');
        return $this->json([
            'url'=>$this->generateUrl('proyecto_findby_plantel',['id'=>$plantel_id])
        ]);
    }

    private function esEliminable(Proyecto $proyecto)
    {
        $em = $this->getDoctrine()->getManager();
        $plan_trabajo=$em->getRepository(PlanTrabajo::class)->findOneByProyecto($proyecto);
        $control_gasto=$em->getRepository(ControlGastos::class)->findOneByProyecto($proyecto);
        $rendicion_cuenta=$em->getRepository(RendicionCuentas::class)->findOneByProyecto($proyecto);
        return $plan_trabajo==null && $control_gasto==null && $rendicion_cuenta==null;
    }


}