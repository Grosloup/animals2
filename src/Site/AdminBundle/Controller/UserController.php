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
use Site\AdminBundle\Exception\UserNotFoundException;
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
        $entity = $this->findUser($id);
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
                //$user->setIsActive(true);
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
        $entity = $this->findUser($id);
        $form = $this->createForm(new EditUserType(), $entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:User:edit.html.twig",
            [
                "form"=>$form->createView(),
                "delete_form"=>$deleteForm->createView(),
                "entity"=>$entity
            ]
        );
    }

    public function updateAction($id, Request $request)
    {
        $em = $this->getEm();
        $entity = $this->findUser($id);
        $form = $this->createForm(new EditUserType(), $entity);
        $form->submit($request);
        if($form->isValid()){
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl("admin_users_index"));
        }
        $deleteForm = $this->createDeleteForm($id);
        return $this->render("AdminBundle:User:edit.html.twig",
            [
                "form"=>$form->createView(),
                "delete_form"=>$deleteForm->createView(),
                "entity"=>$entity
            ]
        );
    }

    public function deleteAction($id, Request $request)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getEm();
            $entity = $em->getRepository('AdminBundle:User')->find($id);

            if (!$entity) {
                throw new UserNotFoundException('Il y a un problème, l\'utilisateur ' . $id . ' n\'existe pas!');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_users_index'));
    }

    public function prodemoteAction($id)
    {
        $entity = $this->findUser($id);
        return $this->render("AdminBundle:User:prodemote.html.twig", ["entity"=>$entity]);
    }

    public function promoteAction($id,$role)
    {
        $entity = $this->findUser($id);
        $roles = $this->container->getParameter("roles");
        $newRole = [$roles[$role]];
        $entity->setRoles($newRole);
        $em = $this->getEm();
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
    }

    public function demoteAction($id,$role)
    {
        $entity = $this->findUser($id);
        $roles = $this->container->getParameter("roles");

        $newRole = [$roles[$role]];
        $entity->setRoles($newRole);
        $em = $this->getEm();
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
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

    public function activateAction($id)
    {
        $entity = $this->findUser($id);
        $em = $this->getEm();
        $entity->setIsActive(true);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
    }

    public function deactivateAction($id)
    {
        $entity = $this->findUser($id);
        $em = $this->getEm();
        $entity->setIsActive(false);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
    }

    public function lockAction($id)
    {
        $entity = $this->findUser($id);
        $em = $this->getEm();
        $entity->setAccountLocked(true);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
    }

    public function unlockAction($id)
    {
        $entity = $this->findUser($id);
        $em = $this->getEm();
        $entity->setAccountLocked(false);
        $em->persist($entity);
        $em->flush();
        return $this->redirect($this->generateUrl("admin_users_index"));
    }

    private function findUser($id)
    {
        $entity = $this->getRepo("AdminBundle:User")->find($id);
        if(!$entity){
            throw new UserNotFoundException('Il y a un problème, l\'utilisateur ' . $id . ' n\'existe pas!');
        }
        return $entity;
    }
}
