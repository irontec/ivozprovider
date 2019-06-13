<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use Ivoz\Core\Infrastructure\Symfony\HttpFoundation\RequestDateTimeResolver;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Doctrine\DBAL\Types\Type as DBALType;

class DateTimeNormalizer implements DateTimeNormalizerInterface
{
    private $classMetadataFactory;
    private $propertyMetadataFactory;
    private $requestDateTimeResolver;

    public function __construct(
        ClassMetadataFactory $classMetadataFactory,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        RequestDateTimeResolver $requestDateTimeResolver
    ) {
        $this->classMetadataFactory = $classMetadataFactory;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->requestDateTimeResolver = $requestDateTimeResolver;
    }

    /**
     * @param string $class
     * @param string $fieldName
     * @param \DateTime $value
     * @return string
     */
    public function normalize($class, $fieldName, \DateTimeInterface $value)
    {
        $targetClass = $this->getPropertyMappedClass($class, $fieldName);
        $isDateTime = $targetClass === 'DateTime';

        $hasTimeZone = $isDateTime
            ? $this->hasTimeZone($class, $fieldName)
            : false;

        if ($hasTimeZone) {
            $value->setTimezone(
                $this->requestDateTimeResolver->getTimezone()
            );
        }

        return $value->format(
            $this->getStringFormat(
                $class,
                $fieldName
            )
        );
    }

    public function denormalize($class, $fieldName, $value = null)
    {
        if (!$value) {
            return $value;
        }

        $targetClass = $this->getPropertyMappedClass($class, $fieldName);
        if ($targetClass !== 'DateTime') {
            return $value;
        }
        $hasTimeZone = $this->hasTimeZone($class, $fieldName);
        $utcTimeZone = new \DateTimeZone('UTC');

        if ($hasTimeZone) {
            $value = new \DateTime(
                $value,
                $this->requestDateTimeResolver->getTimezone()
            );

            $value->setTimezone($utcTimeZone);
        } else {
            $value = new \DateTime(
                $value,
                $utcTimeZone
            );
        }

        return $value;
    }

    private function getPropertyMappedClass($class, $fieldName)
    {
        $propertyMetadata = $this->propertyMetadataFactory->create($class, $fieldName);
        $fieldType = $propertyMetadata->getType();
        if (is_null($fieldType)) {
            return;
        }

        return $fieldType->getClassName();
    }

    protected function getFieldType($class, $field)
    {
        $metadata = $this->classMetadataFactory->getMetadataFor($class);
        $type = $metadata->getTypeOfField($field);

        return $type;
    }

    protected function getStringFormat($class, $field)
    {
        $type = $this->getFieldType($class, $field);

        if ($type === DBALType::DATE) {
            return 'Y-m-d';
        }

        if ($type === DBALType::TIME) {
            return 'H:i:s';
        }

        return 'Y-m-d H:i:s';
    }

    protected function hasTimeZone($class, $field)
    {
        $type = $this->getFieldType($class, $field);

        return in_array(
            $type,
            [
                DBALType::DATETIME,
                DBALType::DATETIMETZ
            ]
        );
    }
}
