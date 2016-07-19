<?php

namespace Blogger\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministracionController extends Controller
{
    public function loginAction()
    {
        return $this->render('BloggerBlogBundle:Administracion:login.html.twig');
    }

    public function registroAction()
    {
        return $this->render('BloggerBlogBundle:Administracion:registro.html.twig');
    }
}
