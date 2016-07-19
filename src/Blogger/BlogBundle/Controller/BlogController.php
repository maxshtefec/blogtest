<?php
// src/Blogger/BlogBundle/Controller/BlogController.php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Blogger\BlogBundle\Entity\Blog;
use Blogger\BlogBundle\Entity\Document;
use Blogger\BlogBundle\Form\BlogType;

/**
 * Controlador del Blog.
 */
class BlogController extends Controller
{
    /**
     * Muestra una entrada del blog
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $blog = $em->getRepository('BloggerBlogBundle:Blog')->find($id);

        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $this->render('BloggerBlogBundle:Blog:show.html.twig', array(
            'blog'      => $blog,
        ));
    }

    /**
     * Crea una entrada del blog
     */
    public function newAction()
    {
        $blog = new Blog();
        $document1 = new Document();
        $blog->addDocument($document1);

        $form = $this->createForm(new BlogType(), $blog);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->submit($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()
                           ->getEntityManager();

                //comprobar como simplificar esta linea que llama dos veces
                $securityContext = $this->container->get('security.context');
                $username = $this->container->get('security.context')->getToken()->getUser();
                if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                    $blog->setAuthor($username);
                }else{
                    $blog->setAuthor("Anónimo");
                }

                $imagenes = $blog->getDocuments();

                foreach ($imagenes as $imagen){
                    if ($imagen->getName() == null){
                        $imagen->setName("Imagen sin Descripción");
                    }
                    if ($imagen->getPath() == null){
                        $imagen->setPath("Sin Ubicación");
                    }
                }

                $blog->setTags("etc");
                $blog->setCreated(new \DateTime());
                $blog->setUpdated($blog->getCreated());

                //ladybug_dump_die($categoria);

                $em->persist($blog);
                $em->flush();

                $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

                // reenvíe el formulario si actualiza la página
                return $this->redirect($this->generateUrl('blogger_blog_newseccion'));
            }
        }

        return $this->render('BloggerBlogBundle:Blog:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
}