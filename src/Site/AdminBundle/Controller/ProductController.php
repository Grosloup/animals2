<?php
/**
 * Date: 10/06/13
 * Time: 21:52
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;

use Site\AdminBundle\Entity\Product;
use Site\AdminBundle\Form\ProductType;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends BaseController implements CRUDInterface
{
    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Product")->findAll();
        return $this->render("AdminBundle:Product:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        return $this->render("AdminBundle:Product:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new Product();
        $form = $this->createForm(new ProductType(), $entity);
        return $this->render("AdminBundle:Product:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new Product();
        $form = $this->createForm(new ProductType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_products_index"));
            }
        }
        return $this->render("AdminBundle:Product:new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new ProductType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Product:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new ProductType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_products_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Product:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $this->findEntity($id);

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_products_index'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
            ;
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
