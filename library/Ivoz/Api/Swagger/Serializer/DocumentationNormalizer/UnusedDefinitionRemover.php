<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;

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

        foreach ($response['definitions'] as $name => $spec) {
            if (in_array($name, $usedDefinitions, true)) {
                continue;
            }

            unset($response['definitions'][$name]);
        }

        return $response;
    }

    private function getUsedDefinitions($object)
    {
        $definitions = [];

        foreach ($object['paths'] as $endpoint => $endpointSpec) {
            foreach ($endpointSpec as $method => $methodSpec) {
                foreach ($methodSpec['responses'] as $responseCode => $responseSpec) {
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

        foreach ($object['definitions'] as $modelName => $modelSpec) {
            foreach ($modelSpec['properties'] as $propertyName => $propertySpec) {
                if (!isset($propertySpec['$ref'])) {
                    continue;
                }

                $ref = $propertySpec['$ref'];
                if (!in_array($ref, $definitions)) {
                    $definitions[] = $this->cleanRef($ref);
                }
            }
        }

        return $definitions;
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
