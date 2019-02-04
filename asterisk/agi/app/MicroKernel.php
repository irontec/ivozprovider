<?php

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class MicroKernel extends Kernel
{
    use MicroKernelTrait;

    protected $fastagi;

    /**
     * @inheritdoc
     */
    public function __construct($environment, $debug, AGI $fastagi = null)
    {
        $this->fastagi = $fastagi;
        return parent::__construct($environment, $debug);
    }

    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Doctrine\Bundle\DoctrineCacheBundle\DoctrineCacheBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Lexik\Bundle\JWTAuthenticationBundle\LexikJWTAuthenticationBundle(),

            /* Core */
            new CoreBundle\CoreBundle(),
        ];
        return $bundles;
    }

    protected function initializeContainer()
    {
        $response = parent::initializeContainer(...func_get_args());
        $this->container->set('fastagi', $this->fastagi);

        return $response;
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        // kernel is a service that points to this class
        // optional 3rd argument is the route name
        $routes->add('/dialplan/users', 'kernel:handleRequestAction');
        $routes->add('/dialplan/userstatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/trunks', 'kernel:handleRequestAction');
        $routes->add('/dialplan/residentials', 'kernel:handleRequestAction');
        $routes->add('/dialplan/retails', 'kernel:handleRequestAction');
        $routes->add('/dialplan/residentialstatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/friends', 'kernel:handleRequestAction');
        $routes->add('/dialplan/headers', 'kernel:handleRequestAction');
        $routes->add('/dialplan/huntgroups', 'kernel:handleRequestAction');
        $routes->add('/dialplan/huntgroupstatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/queues', 'kernel:handleRequestAction');
        $routes->add('/dialplan/queuestatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/faxdial', 'kernel:handleRequestAction');
        $routes->add('/dialplan/faxdialstatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/faxsend', 'kernel:handleRequestAction');
        $routes->add('/dialplan/faxsendstatus', 'kernel:handleRequestAction');
        $routes->add('/dialplan/faxreceivestatus', 'kernel:handleRequestAction');
        $routes->add('/voicemail/sender', 'kernel:handleRequestAction');
    }

    public function handleRequestAction()
    {
        /** @var \Symfony\Component\HttpFoundation\Request $request */
        $request = $this->container->get('request_stack')->getCurrentRequest();

        $uri = str_replace(
            '/',
            '\\',
            $request->getRequestUri()
        );

        $this->registerCommand($uri);

        try {
            /** @var \Dialplan\RouteHandlerAbstract $routeHandler */
            $routeHandler = $this->container->get($uri);
            $routeHandler->process();
        } catch (\Exception $e) {
            $this->fastagi->error($e->getMessage());
        }

        return new Response('');
    }

    protected function registerCommand(string $service)
    {
        /** @var \Ivoz\Core\Domain\Service\DomainEventPublisher $eventPublisher */
        $eventPublisher = $this->container->get('Ivoz\Core\Domain\Service\DomainEventPublisher');

        /** @var \Ivoz\Core\Application\RequestId $requestId */
        $requestId = $this->container->get('Ivoz\Core\Application\RequestId');

        $event = new \Ivoz\Core\Application\Event\CommandWasExecuted(
            $requestId->toString(),
            'AGI:' . $service,
            'process',
            []
        );

        $eventPublisher->publish($event);
    }

    // optional, to use the standard Symfony cache directory
    public function getCacheDir()
    {
        return __DIR__.'/../var/cache/'.$this->getEnvironment();
    }

    // optional, to use the standard Symfony logs directory
    public function getLogDir()
    {
        return __DIR__.'/../var/logs';
    }
}
