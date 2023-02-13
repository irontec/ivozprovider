<?php

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Resource\FileResource;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;
use Symfony\Component\HttpFoundation\Response;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    protected $fastagi;

    /**
     * @inheritdoc
     */
    public function __construct($environment, $debug, AGI $fastagi = null)
    {
        $this->fastagi = $fastagi;
        parent::__construct($environment, $debug);
    }

    protected function initializeContainer()
    {
        $response = parent::initializeContainer();
        $this
            ->container
            ->set('fastagi', $this->fastagi);

        return $response;
    }

    public function handleRequestAction()
    {
        /** @var \Symfony\Component\HttpFoundation\Request $request */
        $request = $this
            ->container
            ->get('request_stack')
            ->getCurrentRequest();

        $uri = str_replace(
            '/',
            '\\',
            $request->getRequestUri()
        );

        $this->registerCommand($uri);

        try {
            /** @var RouteHandlerAbstract $routeHandler */
            $routeHandler = $this->container->get($uri);
            $routeHandler->process();
        } catch (\Exception $e) {
            if ($this->fastagi) {
                $this->fastagi->error($e->getMessage());
            } else {
                echo $e->getMessage();
            }
        }

        return new Response('');
    }

    protected function registerCommand(string $service)
    {
        /** @var \Ivoz\Core\Domain\Service\DomainEventPublisher $eventPublisher */
        $eventPublisher = $this->container->get('Ivoz\Core\Domain\Service\DomainEventPublisher');

        /** @var \Ivoz\Core\Domain\RequestId $requestId */
        $requestId = $this->container->get('Ivoz\Core\Domain\RequestId');

        $event = new \Ivoz\Core\Domain\Event\CommandWasExecuted(
            $requestId->toString(),
            'AGI:' . $service,
            'process',
            [],
            []
        );

        $eventPublisher->publish($event);
    }

    public function getCacheDir()
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function getLogDir()
    {
        return $this->getProjectDir() . '/var/log';
    }

    public function registerBundles()
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader)
    {
        $container->addResource(new FileResource($this->getProjectDir() . '/config/bundles.php'));
        // Feel free to remove the "container.autowiring.strict_mode" parameter
        // if you are using symfony/dependency-injection 4.0+ as it's the default behavior
        $container->setParameter('container.autowiring.strict_mode', true);
        $container->setParameter('container.dumper.inline_class_loader', true);
        $confDir = $this->getProjectDir() . '/config';

        $loader->load($confDir . '/{packages}/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{packages}/' . $this->environment . '/*' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}' . self::CONFIG_EXTS, 'glob');
        $loader->load($confDir . '/{services}_' . $this->environment . self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $confDir = $this->getProjectDir() . '/config';

        $routes->import($confDir . '/{routes}/' . $this->environment . '/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir . '/{routes}/*' . self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir . '/{routes}' . self::CONFIG_EXTS, '/', 'glob');
    }
}
