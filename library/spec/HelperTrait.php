<?php

namespace spec;

trait HelperTrait
{
    protected function getterProphecy($double, array $values, $shouldBeCalled = true)
    {
        foreach ($values as $method => $value) {
            if (is_callable($value)) {
                list($arguments, $returnValue) = $value();
                $prophecy = $double
                    ->{$method}(...$arguments)
                    ->willReturn($returnValue);

                if ($shouldBeCalled) {
                    $prophecy->shouldBeCalled();
                }

                continue;
            }

            $prophecy = $double
                ->{$method}()
                ->willReturn($value);

            if ($shouldBeCalled) {
                $prophecy->shouldBeCalled();
            }
        }
    }

    protected function setterProphecy($double, array $values, $shouldBeCalled = true)
    {
        foreach ($values as $method => $value) {
            if (is_callable($value)) {
                list($arguments, $returnValue) = $value();
                $prophecy = $double
                    ->{$method}(...$arguments)
                    ->willReturn($returnValue);

                if ($shouldBeCalled) {
                    $prophecy->shouldBeCalled();
                }

                continue;
            }

            $prophecy = $double
                ->{$method}($value)
                ->willReturn(null);

            if ($shouldBeCalled) {
                $prophecy->shouldBeCalled();
            }
        }
    }

    protected function fluentSetterProphecy($double, array $values, $shouldBeCalled = true)
    {
        foreach ($values as $method => $value) {
            if (!is_callable($value)) {
                $values[$method] = function () use ($double, $value) {
                    return [[$value], $double];
                };
            }
        }

        $this->setterProphecy($double, $values, $shouldBeCalled);
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
