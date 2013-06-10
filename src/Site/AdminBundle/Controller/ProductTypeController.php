<?php
/**
 * Date: 10/06/13
 * Time: 13:00
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\ProductType;
use Site\AdminBundle\Form\ProductTypeType;
use Symfony\Component\HttpFoundation\Request;

class ProductTypeController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:ProductType")->findAll();
        return $this->render("AdminBundle:ProductType:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        return $this->render("AdminBundle:ProductType:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new ProductType();
        $form = $this->createForm(new ProductTypeType(), $entity);
        return $this->render("AdminBundle:ProductType:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new ProductType();
        $form = $this->createForm(new ProductTypeType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_product_types_index"));
            }
        }
        return $this->render("AdminBundle:ProductType:new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new ProductTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:ProductType:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new ProductTypeType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_product_types_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:ProductType:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
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

        return $this->redirect($this->generateUrl('admin_product_types_index'));
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
        $entity = $this->getRepo("AdminBundle:ProductType")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Type de produit ' . $id . ' introuvable.');
        }
        return $entity;
    }

}
