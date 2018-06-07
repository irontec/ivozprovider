<?php

namespace Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class RepositoryCompiler implements CompilerPassInterface
{
    /**
     * @var ContainerBuilder
     */
    protected $container;

    public function process(ContainerBuilder $container)
    {
        $this->container = $container;

        $this->setRepositoryAliases(
            $this->container->findTaggedServiceIds('domain.repository')
        );
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