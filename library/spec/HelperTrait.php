<?php

namespace spec;

trait HelperTrait
{
    protected function getterProphecy($double, array $values)
    {
        foreach ($values as $method => $value) {

            $double
                ->{$method}()
                ->willReturn($value)
                ->shouldBeCalled();
        }
    }

    protected function fluentSetterProphecy($double, array $values)
    {
        foreach ($values as $method => $value) {

            $double
                ->{$method}($value)
                ->willReturn($double)
                ->shouldBeCalled();
        }
    }

    protected function hydrate($object, $values)
    {
        $reflection = new \ReflectionClass($object);

        foreach ($values as $name => $value) {
            $property = $this->getProperty($reflection, $name);
            $property->setAccessible(true);
            $property->setValue($object, $value);
            $property->setAccessible(false);
        }
    }

    protected function getProperty(\ReflectionClass $reflection, $propertyName)
    {
        $propertyExists = $reflection->hasProperty($propertyName);

        if ($propertyExists) {
            return $reflection->getProperty($propertyName);
        }

        if ($reflection->getParentClass()) {

            return $this->getProperty(
                $reflection->getParentClass(),
                $propertyName
            );
        }

        throw new \Exception(
            'Property ' . $propertyName . ' does not exist'
        );


    }
}