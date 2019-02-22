<?php

namespace Ivoz\Api\Entity\Serializer\Normalizer;

use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Doctrine\DBAL\Types\Type as DBALType;

interface DateTimeNormalizerInterface
{
    public function normalize($class, $fieldName, \DateTimeInterface $value);

    public function denormalize($class, $fieldName, $value = null);
}
