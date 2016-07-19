<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Blogger\BlogBundle\Entity\Enquiry;
use Blogger\BlogBundle\Form\EnquiryType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $blog = $em->getRepository('BloggerBlogBundle:Blog')->getLatestBlogs();

        return $this->render('BloggerBlogBundle:Default:index.html.twig', array(
            'blog' => $blog
        ));
    }

    public function contactoAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // realiza alguna acción, como enviar un correo electrónico

                // Redirige - Esto es importante para prevenir que el usuario
                // reenvíe el formulario si actualiza la página
                return $this->redirect($this->generateUrl('blogger_blog_contacto'));
            }
        }

        return $this->render('BloggerBlogBundle:Default:contacto.html.twig', array(
            'form' => $form->createView()
        ));
    }
}
