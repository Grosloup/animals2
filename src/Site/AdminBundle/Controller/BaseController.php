<?php
/**
 * Date: 05/06/13
 * Time: 13:58
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getEm()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param $repo
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepo($repo)
    {
        return $this->getEm()->getRepository($repo);
    }

    protected function isGranted($role)
    {
        return $this->get("security.context")->isGranted($role);
    }

    protected function getRoute()
    {
        return $this->container->get("request")->attributes->get("_route");
    }
}
