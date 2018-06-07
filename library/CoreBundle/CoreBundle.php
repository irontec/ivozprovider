<?php

namespace CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler;

class CoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(
            new Compiler\RepositoryCompiler()
        );

        $container->addCompilerPass(
            new Compiler\DomainServiceCompiler()
        );

        $container->addCompilerPass(
            new Compiler\LifecycleCompiler()
        );
    }
}
