<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Doctrine\DBAL\Types\Type as DBALType;

class DateTimeNormalizer
{
    /**
     * @var ClassMetadataFactory
     */
    private $classMetadataFactory;

    /**
     * @var TokenStorage
     */
    protected $tokenStorage;

    /**
     * @var PropertyMetadataFactoryInterface
     */
    private $propertyMetadataFactory;

    /**
     * DateTimeDenormalizer constructor.
     * @param TokenStorage $tokenStorage
     * @param ClassMetadataFactory $classMetadataFactory
     */
    public function __construct(
        TokenStorage $tokenStorage,
        ClassMetadataFactory $classMetadataFactory,
        PropertyMetadataFactoryInterface $propertyMetadataFactory
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->classMetadataFactory = $classMetadataFactory;
        $this->propertyMetadataFactory = $propertyMetadataFactory;
    }

    public function normalize($class, $fieldName, \DateTimeInterface $value)
    {
        $targetClass = $this->getPropertyMappedClass($class, $fieldName);
        $isDateTime = $targetClass === 'DateTime';

        $hasTimeZone = $isDateTime
            ? $this->hasTimeZone($class, $fieldName)
            : false;

        if ($hasTimeZone) {
            $value->setTimezone($this->getUserDateTimeZone());
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
                $this->getUserDateTimeZone()
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
    private function getUserDateTimeZone()
    {
        $token = $this->tokenStorage->getToken();

        /** @var TimezoneInterface $user */
        $timeZone = $token
            ->getUser()
            ->getTimezone();

        return new \DateTimeZone(
            $timeZone->getTz()
        );
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
