<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UnusedDefinitionRemover implements NormalizerInterface
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
        $usedDefinitions = $this->getUsedDefinitions($response);

        $unused = [];
        foreach ($response['definitions'] as $name => $spec) {
            if (in_array($name, $usedDefinitions, true)) {
                continue;
            }

            $unused[] = $name;
        }

        foreach ($unused as $name) {
            unset($response['definitions'][$name]);
        }

        return $response;
    }

    private function getUsedDefinitions($object)
    {
        $definitions = [];

        foreach ($object['paths'] as $endpointSpec) {
            foreach ($endpointSpec as $methodSpec) {
                foreach ($methodSpec['responses'] as $responseSpec) {
                    $ref = $this->getResponseRef($responseSpec);
                    if ($ref) {
                        $definitions[] = $this->cleanRef($ref);
                    }
                }

                foreach ($methodSpec['parameters'] as $parameter) {
                    if (!isset($parameter['schema'])) {
                        continue;
                    }
                    $ref = $parameter['schema']['$ref'];
                    if (!in_array($ref, $definitions)) {
                        $definitions[] = $this->cleanRef($ref);
                    }
                }
            }
        }

        foreach ($object['definitions'] as $modelSpec) {
            foreach ($modelSpec['properties'] as $propertySpec) {
                if (!isset($propertySpec['$ref'])) {
                    continue;
                }

                $ref = $propertySpec['$ref'];
                if (!in_array($ref, $definitions)) {
                    $definitions[] = $this->cleanRef($ref);
                }
            }
        }

        return $this->findNestedDefinitions(
            $definitions,
            $object['definitions']
        );
    }


    private function findNestedDefinitions(array $usedDefinitions, \ArrayObject $definitions): array
    {
        $response = [];
        foreach ($usedDefinitions as $definitionName) {
            $response[] = $definitionName;

            $definitionSpec = $definitions[$definitionName];
            foreach ($definitionSpec['properties'] as $propertySpec) {
                $ref = $propertySpec['$ref'] ?? $propertySpec['items']['$ref'] ?? null;
                if (!$ref) {
                    continue;
                }

                $ref = $this->cleanRef($ref);
                if (in_array($ref, $usedDefinitions, true)) {
                    continue;
                }

                if (in_array($ref, $response, true)) {
                    continue;
                }

                $response[] = $ref;
            }
        }

        return $response;
    }

    private function getResponseRef($responseSpec)
    {

        if (!isset($responseSpec['schema'])) {
            return;
        }

        if (isset($responseSpec['schema']['$ref'])) {
            return $responseSpec['schema']['$ref'];
        }

        if (isset($responseSpec['schema']['items']['$ref'])) {
            return $responseSpec['schema']['items']['$ref'];
        }
    }

    private function cleanRef(string $ref)
    {
        $refSegments = explode('/', $ref);

        return array_pop($refSegments);
    }
}
