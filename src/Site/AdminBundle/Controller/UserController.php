<?php
/**
 * Date: 07/06/13
 * Time: 23:02
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:User")->findAll();
        return $this->render("AdminBundle:User:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:User")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Utilisateur introuvable.');
        }
        return $this->render("AdminBundle:User:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        return $this->render("AdminBundle:User:new.html.twig");
    }

    public function createAction(Request $request)
    {
        // TODO: Implement createAction() method.
    }

    public function editAction($id)
    {
        // TODO: Implement editAction() method.
    }

    public function updateAction($id, Request $request)
    {
        // TODO: Implement updateAction() method.
    }

    public function deleteAction($id, Request $request)
    {
        // TODO: Implement deleteAction() method.
    }
}
