<?php

namespace DataFixtures;

use Ivoz\Core\Domain\Model\EntityInterface;

trait FixtureHelperTrait
{
    /**
     * @param string $className
     * @return EntityInterface
     */
    protected function createEntityInstanceWithPublicMethods(string $className)
    {
        $reflectionClass = new \ReflectionClass($className);
        $methods = $reflectionClass->getMethods();
        foreach ($methods as $methods) {
            $methods->setAccessible(true);
        }

        return $reflectionClass->newInstanceWithoutConstructor();
    }
}