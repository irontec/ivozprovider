<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use ApiPlatform\Core\Metadata\Property\Factory\PropertyMetadataFactoryInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class OrphanAttributeFixerDecorator implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $decoratedNormalizer;

    /**
     * @var PropertyMetadataFactoryInterface
     */
    protected $propertyMetadataFactory;

    public function __construct(
        NormalizerInterface $decoratedNormalizer,
        PropertyMetadataFactoryInterface $propertyMetadataFactory
    ) {
        $this->propertyMetadataFactory = $propertyMetadataFactory;
        $this->decoratedNormalizer = $decoratedNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->decoratedNormalizer->supportsNormalization(...func_get_args());
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $response = $this->decoratedNormalizer->normalize(...func_get_args());

        $resourceNames = [];
        foreach ($object->getResourceNameCollection() as $resourceName) {
            $resourceNameSegments = explode('\\', $resourceName);
            $resourceNames[$resourceName] = end($resourceNameSegments);
        }

        foreach ($resourceNames as $fqdn => $name) {
            if (!isset($response['definitions'][$name])) {
                continue;
            }

            $entityDefinition = $response['definitions'][$name];

            if (!$entityDefinition) {
                continue;
            }

            foreach ($entityDefinition['properties'] as $propertyName => $property) {
                $propertyMetadata = $this->propertyMetadataFactory->create(
                    $fqdn,
                    $propertyName
                );

                $propertyType = $propertyMetadata->getType();
                if (!$propertyType) {
                    continue;
                }

                $propertyClass = $propertyMetadata->getType()->getClassName();
                if (!$propertyClass) {
                    continue;
                }

                if (isset($property['$ref'])) {
                    continue;
                }

                $propertyType = $property['type'];
                if ($propertyClass === 'DateTime' && $propertyType === 'string') {
                    continue;
                }

                if ($propertyType === 'array') {
                    continue;
                }

                if ($propertyClass !== $propertyType) {
                    unset($entityDefinition['properties'][$propertyName]);
                }
            }
        }

        return $response;
    }
}
