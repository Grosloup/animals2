<?php
/**
 * Date: 11/06/13
 * Time: 13:24
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AngularBundle\Controller;


use Site\AdminBundle\Controller\CRUDInterface;
use Site\FrontBundle\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AngularController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Product")->findAllToArray();
        $response = new JsonResponse();
        $response->setData($entities);
        return $response;
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        $response = new JsonResponse();
        $response->setData($entity);
        return $response;
    }

    public function newAction()
    {
        // TODO: Implement newAction() method.
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

    private function findEntity($id)
    {
        $entity = $this->getRepo("AdminBundle:Product")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Produit ' . $id . ' introuvable.');
        }
        return $entity;
    }
}
