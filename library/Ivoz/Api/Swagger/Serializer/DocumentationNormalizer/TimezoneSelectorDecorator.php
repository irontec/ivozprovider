<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TimezoneSelectorDecorator implements NormalizerInterface
{
    /**
     * @var NormalizerInterface
     */
    protected $decoratedNormalizer;

    /**
     * @var \ArrayObject
     */
    protected $definitions;

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
        $this->definitions = $response['definitions'];
        $response['paths'] = $this->addTimezoneSelector($response['paths']);

        return $response;
    }

    private function addTimezoneSelector(\ArrayObject $paths)
    {
        $methods = ['get', 'post', 'put'];
        $timeZoneParameter = [
            'name' => '_timezone',
            'in' => 'query',
            'required' => false,
            'type' => 'string',
            'description' => 'Use a time zone of choice instead of the token user one (Applies to both input and output)'
        ];

        foreach ($paths as $name => $path) {
            foreach ($methods as $method) {
                if (!isset($path[$method])) {
                    continue;
                }

                $hasDateTimeProperties = $this->hasDateTimeProperties(
                    $path[$method]
                );

                if (!$hasDateTimeProperties) {
                    continue;
                }

                $paths[$name][$method]['parameters'][] = $timeZoneParameter;
            }
        }

        return $paths;
    }

    private function hasDateTimeProperties(\ArrayObject $path)
    {
        $responseDefinition = $this->getResponseDefinition($path);
        if (!$responseDefinition) {
            return false;
        }

        foreach ($responseDefinition['properties'] as $property) {
            $propertyData = $property->getArrayCopy();
            $format = $propertyData['format'] ?? null;

            if ($format === 'date-time') {
                return true;
            }
        }

        return false;
    }


    /**
     * @return array | null
     */
    private function getResponseDefinition(\ArrayObject $path)
    {
        $successCode = null;
        foreach ($path['responses'] as $code => $value) {
            if ($code >= 200 && $code <= 299) {
                $successCode = $code;
                break;
            }
        }

        if (!$successCode) {
            return null;
        }

        $successReponse = $path['responses'][$successCode]['schema'] ?? null;
        if (!$successReponse) {
            return null;
        }

        $ref = $successReponse['$ref'] ?? $successReponse['items']['$ref'];

        if (!$ref) {
            return null;
        }

        $responseModelName = substr(
            $ref,
            strrpos($ref, '/') + 1
        );

        $responseDefinition = $this->definitions[$responseModelName];
        if (!$responseDefinition) {
            return null;
        }

        return $responseDefinition->getArrayCopy();
    }
}
