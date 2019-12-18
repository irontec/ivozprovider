<?php

namespace Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler;

use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class LifecycleCompiler
 * Link services into their ServiceCollection
 */
class LifecycleCompiler implements CompilerPassInterface
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

        $this->buildService(
            $this->getLifecycleServices()
        );

        $domainEventPublisher = $this->container->getDefinition(DomainEventPublisher::class);
        $domainEventSubscribers = $this->getDomainEventSubscriberServices();
        foreach ($domainEventSubscribers as $domainEventSubscriber) {
            $domainEventPublisher->addMethodCall('subscribe', [$domainEventSubscriber]);
        }
    }

    /**
     * @return void
     */
    protected function buildService(array $serviceCollection, $collectionClassName = null)
    {
        foreach ($serviceCollection as $tag => $services) {
            $event = substr(
                $tag,
                strrpos($tag, '.') + 1
            );
            $tagCollectionClassName = !empty($collectionClassName)
                ? $collectionClassName
                : $this->getLifeCycleCollectionClass($tag);

            $collection = $this->container->getDefinition($tagCollectionClassName);

            foreach ($services as $key => $class) {
                $tagProperties = is_subclass_of($class, LifecycleEventHandlerInterface::class)
                    ? $class::getSubscribedEvents()
                    : [];

                if (!$collection->hasTag($class)) {
                    $collection->addTag(
                        $class,
                        $tagProperties
                    );
                }

                $services[$key] = new Reference($class);
            }

            $collection->addMethodCall('setServices', [$event, $services]);
        }
    }

    /**
     * @return string|null
     */
    protected function getLifeCycleCollectionClass($serviceTag)
    {
        $tagSegments = explode('.', $serviceTag);
        array_pop($tagSegments);
        $sharedAliasPrefix = implode('.', $tagSegments);
        $collectionAlias = $sharedAliasPrefix . '.service_collection';
        $definition = $this->container->findDefinition($collectionAlias);

        return $definition->getClass();
    }

    /**
     * @return array
     */
    protected function getLifecycleServices(): array
    {
        $services = [];
        $servicesDefinitions = $this->container->getDefinitions();

        /**
         * @var Definition $definition
         */
        foreach ($servicesDefinitions as $definition) {
            $tags = array_filter($definition->getTags(), function ($key) {
                return (bool) (strpos($key, 'lifecycle.') !== false);
            }, ARRAY_FILTER_USE_KEY);

            if (empty($tags)) {
                continue;
            }

            foreach ($tags as $name => $arguments) {
                if (!array_key_exists($name, $services)) {
                    $services[$name] = array();
                }
                $services[$name] = $this->getServicesByTag($name);
            }
        }

        return $services;
    }

    protected function getDomainEventSubscriberServices(): array
    {
        $services = [];
        $servicesDefinitions = $this->container->getDefinitions();

        /**
         * @var Definition $definition
         */
        foreach ($servicesDefinitions as $definition) {
            if ($definition->hasTag('domain.event.subscriber')) {
                $services[] = $definition;
            }
        }

        return $services;
    }

    /**
     * @return array-key[]
     *
     * @psalm-return array<int, array-key>
     */
    protected function getServicesByTag($tag): array
    {
        $services = $this->container->findTaggedServiceIds($tag);

        /**
         * @var Definition $a
         * @var Definition $b
         */
        uasort($services, function ($a, $b) {
            return $a[0]['priority'] > $b[0]['priority'];
        });

        return array_keys($services);
    }
}
