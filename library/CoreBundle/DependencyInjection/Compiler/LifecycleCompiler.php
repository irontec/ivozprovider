<?php

namespace CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Ivoz\Core\Domain\Service\LifecycleEventListener;
use Ivoz\Core\Domain\Service\PersistErrorHandlerServiceCollection;

class LifecycleCompiler implements CompilerPassInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function process(ContainerBuilder $container)
    {
        $this->container = $container;

        $this->buildService(
            $this->getLifecycleServices()
        );

        $this->buildService(
            $this->getErrorHandlerServices(),
            PersistErrorHandlerServiceCollection::class
        );
    }

    protected function buildService(array $serviceCollection, $collectionClassName = null)
    {
        foreach ($serviceCollection as $tag => $services) {

            $tagCollectionClassName = !empty($collectionClassName)
                ? $collectionClassName
                : $this->getLifeCycleCollectionClass($tag);

            $collection = $this->container->autowire($tag, $tagCollectionClassName);
            $collection->setPublic(true);

            foreach ($services as $key => $class) {
                $services[$key] = new Reference($class);
            }

            $collection->addMethodCall('setServices', [$services]);
        }
    }

    protected function getLifeCycleCollectionClass($serviceTag)
    {
        $tagSegments = explode('.', $serviceTag);
        array_pop($tagSegments);
        $sharedAliasPrefix = implode('.', $tagSegments);
        $collectionAlias = $sharedAliasPrefix . '.service_collection';
        $definition = $this->container->findDefinition($collectionAlias);

        return $definition->getClass();
    }

    protected function getLifecycleServices()
    {
        $services = [];
        $servicesDefinitions = $this->container->getDefinitions();

        /**
         * @var Definition $definition
         */
        foreach ($servicesDefinitions as $definition) {

            $tags = array_filter($definition->getTags(), function ($key) {

                if (strpos($key, 'lifecycle.') === false) {
                    return false;
                }

                if (strpos($key, '.error_handler') !== false) {
                    return false;
                }

                return true;

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

    protected function getErrorHandlerServices()
    {
        $services = [];
        $servicesDefinitions = $this->container->getDefinitions();

        /**
         * @var Definition $definition
         */
        foreach ($servicesDefinitions as $definition) {

            $tags = array_filter($definition->getTags(), function ($key) {

                if (strpos($key, '.lifecycle.') === false) {
                    return false;
                }

                return (strpos($key, '.error_handler') !== false);

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

    protected function getServicesByTag($tag)
    {
        $services = $this->container->findTaggedServiceIds($tag);

        /**
         * @var Definition $a
         * @var Definition $b
         */
        uasort($services, function ($a, $b) use ($tag) {
            return $a[0]['priority'] > $b[0]['priority'];
        });

        return array_keys($services);
    }
}