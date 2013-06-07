<?php
/**
 * Date: 05/06/13
 * Time: 13:17
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


class MiscController extends BaseController
{
    public function indexAction()
    {
        $colors = $this->getRepo("AdminBundle:Color")->findAll();
        $iucns = [];
        if($this->container->hasParameter("iucn")){
            $iucns = $this->container->getParameter("iucn");
        }
        $sexes = [];
        if($this->container->hasParameter("sexes")){
            $sexes = $this->container->getParameter("sexes");
        }
        $status = [];
        if($this->container->hasParameter("status")){
            $status = $this->container->getParameter("status");
        }
        $eventTypes = $this->getRepo("AdminBundle:EventType")->findAll();
        return $this->render("AdminBundle:Misc:index.html.twig",
            ["colors"=>$colors, "iucns"=>$iucns, "sexes"=>$sexes, "status"=>$status, "event_types"=>$eventTypes]);
    }
}
