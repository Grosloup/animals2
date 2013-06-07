<?php
/**
 * Date: 07/06/13
 * Time: 23:02
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\AdminBundle\Controller;


use Site\AdminBundle\Entity\User;
use Site\AdminBundle\Form\EditUserType;
use Site\AdminBundle\Form\RegisterUserType;
use Symfony\Component\HttpFoundation\Request;

class UserController extends BaseController implements CRUDInterface
{

    public function indexAction()
    {
        $entities = $this->getRepo("AdminBundle:User")->findAll();
        return $this->render("AdminBundle:User:index.html.twig",["entities"=>$entities]);
    }

    public function showAction($id)
    {
        $entity = $this->getRepo("AdminBundle:User")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Utilisateur introuvable.');
        }
        return $this->render("AdminBundle:User:show.html.twig",["entity"=>$entity]);
    }

    public function newAction()
    {
        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);
        return $this->render("AdminBundle:User:new.html.twig",["form"=>$form->createView()]);
    }

    public function createAction(Request $request)
    {
        $entity = new User();
        $form = $this->createForm(new RegisterUserType(), $entity);
        if($request->isMethod("POST")){
            $form->submit($request);
            if($form->isValid()){
                $user = $form->getData();
                $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));
                $user->setIsActive(true);
                $em = $this->getEm();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl("admin_users_index"));
            }
        }

        return $this->render("AdminBundle:User:new.html.twig",["form"=>$form->createView()]);
    }

    public function editAction($id)
    {
        $entity = $this->getRepo("AdminBundle:User")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Utilisateur introuvable");
        }
        $form = $this->createForm(new EditUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:User:edit.html.twig",["form"=>$form->createView(),"delete_form"=>$deleteForm->createView(), "entity"=>$entity]);
    }

    public function updateAction($id, Request $request)
    {
        // TODO: Implement updateAction() method.
    }

    public function deleteAction($id, Request $request)
    {
        // TODO: Implement deleteAction() method.
    }

    public function prodemoteAction($id)
    {
        $entity = $this->getRepo("AdminBundle:User")->find($id);
        if(!$entity){
            throw $this->createNotFoundException("Utilisateur introuvable");
        }
        // TODO: promote demote Action
        return $this->render("AdminBundle:User:prodemote.html.twig");
    }

    private function encodePassword(User $user, $password)
    {
        $factory = $this->get("security.encoder_factory");
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($password, $user->getSalt());
        return $password;
    }
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
            ;
    }

}
