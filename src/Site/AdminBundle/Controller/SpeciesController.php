<?php
/**
 * Date: 10/06/13
 * Time: 07:38
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\Species;
use Site\AdminBundle\Form\SpeciesType;
use Symfony\Component\HttpFoundation\Request;

class SpeciesController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Species")->findAll();
        return $this->render("AdminBundle:Species:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->findEntity($id);
        return $this->render("AdminBundle:Species:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new Species();
        $form = $this->createForm(new SpeciesType(), $entity);
        return $this->render("AdminBundle:Species:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new Species();
        $form = $this->createForm(new SpeciesType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_species_index"));
            }
        }
        return $this->render("AdminBundle:Species:new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new SpeciesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Species:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $entity = $this->findEntity($id);
        $form = $this->createForm(new SpeciesType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_species_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Species:edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
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

        return $this->redirect($this->generateUrl('admin_species_index'));
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
        $entity = $this->getRepo("AdminBundle:Species")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Espèce ' . $id . ' introuvable.');
        }
        return $entity;
    }
}
