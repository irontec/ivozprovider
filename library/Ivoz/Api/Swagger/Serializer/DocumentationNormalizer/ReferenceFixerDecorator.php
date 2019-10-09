<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;

class ReferenceFixerDecorator implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $decoratedNormalizer;

    public function __construct(
        NormalizerInterface $decoratedNormalizer
    ) {
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
        $response['definitions'] = $this->fixRelationReferences($response['definitions']);

        return $response;
    }

    private function isEntity($resourceName)
    {
        if (strpos($resourceName, '_')) {
            return false;
        }

        return true;
    }

    private function hasContext($definitionName)
    {
        $segments = explode('-', $definitionName);

        return count($segments) > 1;
    }

    private function fixRelationReferences(\ArrayObject $definitions)
    {
        $definitionKeys = array_keys($definitions->getArrayCopy());
        foreach ($definitionKeys as $key) {
            if (!$this->isEntity($key)) {
                if ($this->hasContext($key)) {
                    unset($definitions[$key]);
                }
                continue;
            }

            if (!array_key_exists('properties', $definitions[$key])) {
                continue;
            }

            $context = explode('-', $key);
            foreach ($definitions[$key]['properties'] as $propertyKey => $property) {
                $definitions[$key]['properties'][$propertyKey] = $this->fixRelationProperty($property, $context[1] ?? '');
                if (is_null($definitions[$key]['properties'][$propertyKey])) {
                    unset($definitions[$key]['properties'][$propertyKey]);
                }
            }
        }

        return $definitions;
    }

    private function fixRelationProperty($property, $context = null)
    {
        $isCollection = array_key_exists('items', $property);
        $isReference = array_key_exists('$ref', $property);

        if (!($isCollection || $isReference)) {
            return $property;
        }

        if ($isReference) {
            return $this->setContext($property, $context);
        }

        $hasRefAttr = array_key_exists('$ref', $property['items']);
        $hasTypeAttr = array_key_exists('type', $property['items']);

        if (!$hasRefAttr && !$hasTypeAttr) {
            return null;
        }

        if ($hasRefAttr) {
            $property['items'] = $this->setContext($property['items'], $context);
        }

        return $property;
    }

    private function setContext($property, $context)
    {
        $noSublevelContexts = [
            DataTransferObjectInterface::CONTEXT_SIMPLE,
            DataTransferObjectInterface::CONTEXT_COLLECTION
        ];

        if ($this->isEntity($property['$ref']) && in_array($context, $noSublevelContexts)) {
            unset($property['$ref']);
            $property['type'] = 'integer';
            return $property;
        }

        $refSegments = explode('-', $property['$ref']);
        $property['$ref'] = $refSegments[0];

        if (array_key_exists('description', $property)) {
            unset($property['description']);
        }

        return $property;
    }
}
