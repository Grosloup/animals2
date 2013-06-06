<?php
/**
 * Date: 07/06/13
 * Time: 00:57
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\EventType;
use Site\AdminBundle\Form\EventTypeType;
use Symfony\Component\HttpFoundation\Request;

class EventTypeController extends BaseController
{
    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:EventType")->findAll();
        return $this->render("AdminBundle:Misc:EventType/index.html.twig",["entities"=>$entities]);
    }

    public function newAction()
    {
        $entity = new EventType();
        $form = $this->createForm(new EventTypeType(), $entity);
        return $this->render("AdminBundle:Misc:EventType/new.html.twig",["form"=>$form->createView()]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:EventType")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException("Type d'événement introuvable.");
        }
        return $this->render("AdminBundle:Misc:EventType/show.html.twig",["entity"=>$entity]);
    }

    public function createAction(Request $request)
    {
        $entity = new EventType();
        $form = $this->createForm(new EventTypeType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_misc_homepage"));
            }
        }
        return $this->render("AdminBundle:Misc:EventType/new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->getRepo("AdminBundle:EventType")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException("Type d'événement introuvable.");
        }
        $form = $this->createForm(new EventTypeType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:EventType/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getEm();
        $entity = $em->getRepository("AdminBundle:EventType")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Type d'événement introuvable");
        }
        $form = $this->createForm(new EventTypeType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_misc_homepage"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:EventType/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $em->getRepository('AdminBundle:EventType')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException("Type d'événement introuvable.");
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_misc_homepage'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
            ;
    }
}
