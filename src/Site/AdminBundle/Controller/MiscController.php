<?php
/**
 * Date: 05/06/13
 * Time: 13:17
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MiscController extends Controller
{
    public function indexAction()
    {
        return $this->render("AdminBundle:Misc:index.html.twig");
    }
}
