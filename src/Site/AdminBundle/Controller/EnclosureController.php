<?php
/**
 * Date: 08/06/13
 * Time: 13:52
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\Enclosure;
use Site\AdminBundle\Form\EnclosureType;
use Symfony\Component\HttpFoundation\Request;

class EnclosureController extends BaseController
{
    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:Enclosure")->findAll();
        return $this->render("AdminBundle:Misc:Enclosure/index.html.twig",["entities"=>$entities]);
    }

    public function newAction()
    {
        $entity = new Enclosure();
        $form = $this->createForm(new EnclosureType(), $entity);
        return $this->render("AdminBundle:Misc:Enclosure/new.html.twig",["form"=>$form->createView()]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:Enclosure")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Enclos introuvable.');
        }
        return $this->render("AdminBundle:Misc:Enclosure/show.html.twig",["entity"=>$entity]);
    }

    public function createAction(Request $request)
    {
        $entity = new Enclosure();
        $form = $this->createForm(new EnclosureType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_misc_homepage"));
            }
        }
        return $this->render("AdminBundle:Misc:Enclosure/new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->getRepo("AdminBundle:Enclosure")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Enclos introuvable.');
        }
        $form = $this->createForm(new EnclosureType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:Enclosure/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getEm();
        $entity = $em->getRepository("AdminBundle:Enclosure")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Enclos introuvable");
        }
        $form = $this->createForm(new EnclosureType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_misc_homepage"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:Enclosure/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $em->getRepository('AdminBundle:Enclosure')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Enclos introuvable.');
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
