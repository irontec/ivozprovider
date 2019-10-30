<?php

namespace Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler;

use Ivoz\Core\Domain\Service\DomainEventSubscriberInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Application\Helper\LifecycleServiceHelper;

/**
 * Class DomainServiceCompiler
 * Auto register and configure services
 */
class DomainServiceCompiler implements CompilerPassInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    /**
     * @return void
     */
    public function process(ContainerBuilder $container)
    {
        $this->container = $container;

        // Register collections
        $lifecycleServiceCollections = $this->getLifecycleServiceCollections();
        foreach ($lifecycleServiceCollections as $lifecycleService) {
            $this->configureLifecycleCollectionService($lifecycleService);
        }

        // Register lifecycle services
        $lifecycleServices = $this->getLifecycleEventHandlerServices();
        foreach ($lifecycleServices as $lifecycleService) {
            $subscribedEvents = $lifecycleService::getSubscribedEvents();
            $this->configureLifecycleService($lifecycleService, $subscribedEvents);
        }

        // Register domain event services
        $domainEventSubscribers = $this->getDomainEventSubscribers();
        foreach ($domainEventSubscribers as $domainEventSubscriber) {
            $this->configureDomainEventSubscribers($domainEventSubscriber);
        }
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
    protected function configureLifecycleCollectionService($fqdn)
    {
        $service = $this->container->getDefinition($fqdn);
        $service->setPublic(true);
        $service->setAutowired(true);

        $tag = LifecycleServiceHelper::getServiceCollectionTag($fqdn);
        $this->container
            ->setAlias($tag, $fqdn)
            ->setPublic(true);
    }

    /**
     * @return void
     */
    protected function configureDomainEventSubscribers($fqdn)
    {
        $service = $this->container->getDefinition($fqdn);
        $service->addTag('domain.event.subscriber');

        $interfaces = class_implements($fqdn);
        $serviceTagName = null;
        foreach ($interfaces as $interface) {
            if ($interface === DomainEventSubscriberInterface::class) {
                continue;
            }

            $isDomainEventInterface = is_subclass_of(
                $fqdn,
                DomainEventSubscriberInterface::class
            );

            if (!$isDomainEventInterface) {
                continue;
            }

            $serviceTagName = LifecycleServiceHelper::getServiceTagByServiceFqdn(
                $interface,
                LifecycleEventHandlerInterface::EVENT_ON_DOMAIN_EVENT
            );

            break;
        }

        if (!$serviceTagName) {
            $serviceTagName = LifecycleServiceHelper::getServiceTagByServiceFqdn(
                $fqdn,
                LifecycleEventHandlerInterface::EVENT_ON_DOMAIN_EVENT
            );
        }

        $service->addTag($serviceTagName);
        $service->setPublic(true);
    }

    /**
     * @return array
     *
     * @psalm-return array<int, array-key>
     */
    protected function getLifecycleEventHandlerServices(): array
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

    /**
     * @return array
     *
     * @psalm-return array<int, array-key>
     */
    protected function getLifecycleServiceCollections(): array
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
            ARRAY_FILTER_USE_KEY
        );

        return array_keys($services);
    }

    /**
     * @return array
     *
     * @psalm-return array<int, array-key>
     */
    protected function getDomainEventSubscribers(): array
    {
        $domainServices = $this->container->findTaggedServiceIds('domain.service');
        $services = array_filter(
            $domainServices,
            function ($serviceId) {
                $response = is_subclass_of(
                    $serviceId,
                    DomainEventSubscriberInterface::class
                );

                return $response;
            },
            ARRAY_FILTER_USE_KEY
        );

        return array_keys($services);
    }

    /**
     * @param Definition[] $services
     *
     * @return void
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
