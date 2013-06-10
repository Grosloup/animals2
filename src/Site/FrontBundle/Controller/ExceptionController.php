<?php
/**
 * Date: 09/06/13
 * Time: 13:52
 * @author Nicolas Canfrere <nico.canfrere at gmail.com>
 */

namespace Site\FrontBundle\Controller;

use Symfony\Bundle\TwigBundle\Controller\ExceptionController as ExController;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\FlattenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Log\DebugLoggerInterface;

class ExceptionController extends ExController implements ContainerAwareInterface
{
    public $exceptionClass;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    public function showAction(Request $request, FlattenException $exception, DebugLoggerInterface $logger = null, $format = 'html')
    {

        $this->exceptionClass = $exception->getClass();

        return parent::showAction($request, $exception, $logger, $format);
    }

    protected function findTemplate(Request $request, $format, $code, $debug)
    {
        $debug = false;
        if($this->exceptionClass == 'Site\AdminBundle\Exception\UserNotFoundException'){
            return 'AdminBundle:Exception:user_not_found.html.twig';
        }

        return parent::findTemplate($request, $format, $code, $debug);
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @return $this
     * @api
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
        return $this;
    }
}
