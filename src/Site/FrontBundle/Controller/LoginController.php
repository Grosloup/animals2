<?php
/**
 * Date: 07/06/13
 * Time: 22:43
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\FrontBundle\Controller;


use Symfony\Component\Security\Core\SecurityContext;

class LoginController extends BaseController
{
    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                SecurityContext::AUTHENTICATION_ERROR
            );
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render(
            'FrontBundle:Login:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $session->get(SecurityContext::LAST_USERNAME),
                'error'         => $error,
            )
        );
    }

    public function logoutAction()
    {

    }

    public function loginCheckAction()
    {

    }
}
