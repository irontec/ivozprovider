<?php

namespace Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler;

use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Application\Helper\LifecycleServiceHelper;

class DomainServiceCompiler implements CompilerPassInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function process(ContainerBuilder $container)
    {
        $this->container = $container;

        $lifecycleServiceCollections = $this->getLifecycleServiceCollections();
        foreach ($lifecycleServiceCollections as $lifecycleService) {
            $this->configureLifecycleCollectionService($lifecycleService);
        }

        $lifecycleServices = $this->getLifecycleEventHandlerServices();
        foreach ($lifecycleServices as $lifecycleService) {
            $subscribedEvents = $lifecycleService::getSubscribedEvents();
            $this->configureLifecycleService($lifecycleService, $subscribedEvents);
        }
    }

    protected function configureLifecycleService($fqdn, $subscribedEvents)
    {
        $service = $this->container->getDefinition($fqdn);
        foreach ($subscribedEvents as $event => $prioriry) {

            if (!in_array($event, LifecycleEventHandlerInterface::EVENT_TYPES)) {
                throw new \Exception("Unknown event $event");
            }

            $serviceTagName = LifecycleServiceHelper::getServiceTagByServiceFqdn($fqdn, $event);
            $service->addTag(
                $serviceTagName,
                ['priority' => $prioriry]
            );
            $service->setPublic(true);
        }
    }

    protected function configureLifecycleCollectionService($fqdn)
    {
        $service = $this->container->getDefinition($fqdn);
        $service->setPublic(true);

        $tag =  LifecycleServiceHelper::getServiceCollectionTag($fqdn);
        $this->container->setAlias($tag, $fqdn);
    }

    protected function getLifecycleEventHandlerServices()
    {
        $domainServices = $this->container->findTaggedServiceIds('domain.service');
        $services = array_filter(
            $domainServices,
            function ($serviceId) {
                $response = is_subclass_of(
                    $serviceId,
                    LifecycleEventHandlerInterface::class
                );

                return $response;
            },
            ARRAY_FILTER_USE_KEY
        );

        return array_keys($services);
    }

    protected function getLifecycleServiceCollections()
    {
        $domainServices = $this->container->findTaggedServiceIds('domain.service');
        $services = array_filter(
            $domainServices,
            function ($serviceId) {
                $response = is_subclass_of(
                    $serviceId,
                    LifecycleServiceCollectionInterface::class
                );

                return $response;
            },
            ARRAY_FILTER_USE_KEY);

        return array_keys($services);
    }

    /**
     * @param Definition[] $services
     */
    protected function setRepositoryAliases(array $services)
    {

        foreach ($services as $fqdn => $value) {

            $repositoryInterface = preg_replace(
                '/(.*)Infrastructure\\\\Persistence\\\\Doctrine\\\\(.*)DoctrineRepository/',
                '${1}Domain\Model\\\\${2}\\\\${2}Repository',
                $fqdn
            );

            $this->container->setAlias(
                $repositoryInterface,
                $fqdn
            );
        }
    }
}