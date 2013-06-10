<?php
/**
 * Date: 10/06/13
 * Time: 07:35
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\Animal;
use Site\AdminBundle\Form\AnimalType;
use Symfony\Component\HttpFoundation\Request;

class AnimalController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Animal")->findAll();
        return $this->render("AdminBundle:Animal:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        return $this->render("AdminBundle:Animal:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new Animal();
        $form = $this->createForm(new AnimalType(), $entity);
        return $this->render("AdminBundle:Animal:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new Animal();
        $form = $this->createForm(new AnimalType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_animal_index"));
            }
        }
        return $this->render("AdminBundle:Animal:new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new AnimalType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Animal:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new AnimalType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_animal_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Animal:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
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

        return $this->redirect($this->generateUrl('admin_animal_index'));
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
        $entity = $this->getRepo("AdminBundle:Animal")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Animal ' . $id . ' introuvable.');
        }
        return $entity;
    }
}
