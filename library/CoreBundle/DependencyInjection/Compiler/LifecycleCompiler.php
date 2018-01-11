<?php

namespace CoreBundle\DependencyInjection\Compiler;

use Ivoz\Core\Infrastructure\Symfony\DependencyInjection\Compiler\LifecycleCompilerTrait;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class LifecycleCompiler implements CompilerPassInterface
{
    use LifecycleCompilerTrait;
}
