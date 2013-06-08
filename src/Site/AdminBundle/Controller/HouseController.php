<?php
/**
 * Date: 08/06/13
 * Time: 13:00
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;

use Site\AdminBundle\Entity\House;
use Site\AdminBundle\Form\HouseType;
use Symfony\Component\HttpFoundation\Request;

class HouseController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:House")->findAll();
        return $this->render("AdminBundle:Misc:House/index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:House")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Bâtiment introuvable.');
        }
        return $this->render("AdminBundle:Misc:House/show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new House();
        $form = $this->createForm(new HouseType(), $entity);
        return $this->render("AdminBundle:Misc:House/new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new House();
        $form = $this->createForm(new HouseType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_misc_homepage"));
            }
        }
        return $this->render("AdminBundle:Misc:House/new.html.twig", ["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->getRepo("AdminBundle:House")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Bâtiment introuvable.');
        }
        $form = $this->createForm(new HouseType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:House/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getEm();
        $entity = $em->getRepository("AdminBundle:House")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Bâtiment introuvable");
        }
        $form = $this->createForm(new HouseType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_misc_homepage"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:Misc:House/edit.html.twig", ["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $em->getRepository('AdminBundle:House')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Bâtiment introuvable.');
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
