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
            $property = $reflection->getProperty($name);
            $property->setAccessible(true);
            $property->setValue($object, $value);
            $property->setAccessible(false);
        }
    }
}