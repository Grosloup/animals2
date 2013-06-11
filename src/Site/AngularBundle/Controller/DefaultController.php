<?php

namespace Site\AngularBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AngularBundle:Default:index.html.twig');
    }
}
