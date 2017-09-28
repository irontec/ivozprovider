<?php

namespace CoreBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use CoreBundle\DependencyInjection\Compiler\LifecycleCompiler;

class CoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new LifecycleCompiler());
    }
}
