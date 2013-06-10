<?php
/**
 * Date: 10/06/13
 * Time: 13:07
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

/*
 * renommer la classe
 * remplacer BasketState par le nom de l'entitÃ©. attention nom complet de classe !
 * remplacer AdminBundle:BasketState
 * remplacer BasketStateType
 * remplacer admin_basket_states_index
 * remplacer Etat de panier dans exception
 *
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\BasketState;
use Site\AdminBundle\Form\BasketStateType;
use Symfony\Component\HttpFoundation\Request;

class BasketStateController extends BaseController implements CRUDInterface
{
    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:BasketState")->findAll();
        return $this->render("AdminBundle:BasketState:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        return $this->render("AdminBundle:BasketState:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new BasketState();
        $form = $this->createForm(new BasketStateType(), $entity);
        return $this->render("AdminBundle:BasketState:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new BasketState();
        $form = $this->createForm(new BasketStateType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_basket_states_index"));
            }
        }
        return $this->render("AdminBundle:BasketState:new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new BasketStateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:BasketState:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new BasketStateType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_basket_states_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:BasketState:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
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

        return $this->redirect($this->generateUrl('admin_basket_states_index'));
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
        $entity = $this->getRepo("AdminBundle:BasketState")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Etat de panier ' . $id . ' introuvable.');
        }
        return $entity;
    }
}
