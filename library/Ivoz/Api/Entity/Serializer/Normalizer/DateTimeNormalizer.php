<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Doctrine\DBAL\Types\Type as DBALType;

class DateTimeNormalizer implements DateTimeNormalizerInterface
{
    private $classMetadataFactory;
    private $propertyMetadataFactory;
    private $requestStack;

    /**
     * DateTimeNormalizer constructor.
     * @param ClassMetadataFactory $classMetadataFactory
     * @param PropertyMetadataFactoryInterface $propertyMetadataFactory
     * @param RequestStack $requestStack
     */
    public function __construct(
        ClassMetadataFactory $classMetadataFactory,
        PropertyMetadataFactoryInterface $propertyMetadataFactory,
        RequestStack $requestStack
    ) {
        $this->classMetadataFactory = $classMetadataFactory;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->requestStack = $requestStack;
    }

    public function normalize($class, $fieldName, \DateTimeInterface $value)
    {
        $targetClass = $this->getPropertyMappedClass($class, $fieldName);
        $isDateTime = $targetClass === 'DateTime';

        $hasTimeZone = $isDateTime
            ? $this->hasTimeZone($class, $fieldName)
            : false;

        if ($hasTimeZone) {
            $value->setTimezone($this->getTimezone());
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
                $this->getTimezone()
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

    /**
     * @return \DateTimeZone
     */
    private function getTimezone()
    {
        $reqTimezone = $this->getRequestTimeZone();
        if ($reqTimezone) {
            return $reqTimezone;
        }

        return new \DateTimeZone('UTC');
    }

    private function getRequestTimeZone()
    {
        $request = $this->requestStack->getCurrentRequest();

        $timezone = $request->query->get('_timezone', null);
        if (!$timezone) {
            return;
        }

        return new \DateTimeZone($timezone);
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
