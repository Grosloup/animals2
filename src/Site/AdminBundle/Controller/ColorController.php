<?php
/**
 * Date: 06/06/13
 * Time: 00:16
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\Color;
use Site\AdminBundle\Form\ColorType;
use Symfony\Component\HttpFoundation\Request;

class ColorController extends BaseController
{
    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Color")->findAll();
        return $this->render("AdminBundle:Misc:Color/index.html.twig",["entities"=>$entities]);
    }

    public function newAction()
    {
        $entity = new Color();
        $form = $this->createForm(new ColorType(), $entity);
        return $this->render("AdminBundle:Misc:Color/new.html.twig",["form"=>$form->createView()]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:Color")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Couleur introuvable.');
        }
        return $this->render("AdminBundle:Misc:Color/show.html.twig",["entity"=>$entity]);
    }

    public function createAction(Request $request)
    {
        $entity = new Color();
        $form = $this->createForm(new ColorType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_misc_homepage"));
            }
        }
        return $this->render("AdminBundle:Misc:Color/new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->getRepo("AdminBundle:Color")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Couleur introuvable.');
        }
        $form = $this->createForm(new ColorType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:Color/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getEm();
        $entity = $em->getRepository("AdminBundle:Color")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Couleur introuvable");
        }
        $form = $this->createForm(new ColorType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_misc_homepage"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:Color/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $em->getRepository('AdminBundle:Color')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Couleur introuvable.');
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
