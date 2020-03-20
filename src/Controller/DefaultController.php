<?php

namespace App\Controller;

use App\Form\ContactoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/estatica/{page}", name="estatica", requirements={"page" = "api|cookies|faq|nosotros|privacidad|terminos"})
     */
    public function estatica($page)
    {
        return $this->render('default/estatica/'.$page.'.html.twig');
    }

    /**
     * @Route("/contactanos", name="contactanos")
     */
    public function contactanos(Request $request, \Swift_Mailer $mailer)
    {
        $form=$this->createForm(ContactoType::class,null,['action'=>$this->generateUrl('contactanos'),'method'=>'POST']);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $correo=$form->get('correo')->getData();
            $parameters=['nombre'=>$form->get('nombre')->getData(),
                         'correo'=>$correo,
                         'mensaje'=>$form->get('mensaje')->getData(),
            ];
            $message = (new \Swift_Message('Xitlali'))
                ->setFrom($correo)
                ->setTo($this->getParameter('destiny_email'))
                ->setBody(
                    $this->renderView(
                        'layout/emails/contactanos.html.twig',
                        $parameters
                    ),
                    'text/html'
                )

                // you can remove the following code if you don't define a text version for your emails
                ->addPart(
                    $this->renderView(
                        'layout/emails/contactanos.txt.twig',
                        $parameters
                    ),
                    'text/plain'
                );

            $mailer->send($message);
            $this->addFlash('success','El mensaje fue enviado satisfactoriamente');
            return $this->redirectToRoute('contactanos');
        }
        return $this->render('default/contactanos.html.twig',['form'=>$form->createView()]);
    }
}
