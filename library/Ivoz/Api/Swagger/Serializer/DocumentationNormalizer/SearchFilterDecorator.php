<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class SearchFilterDecorator implements NormalizerInterface
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
        $response['paths'] = $this->fixPathParameters($response['paths']);

        return $response;
    }

    private function fixPathParameters(\ArrayObject $paths)
    {
        foreach ($paths as $name => $path) {
            if (strpos($name, '{') !== false) {
                continue;
            }

            if (!isset($path['get'])) {
                continue;
            }

            if (!isset($path['get']['responses']['200']['schema']['items'])) {
                continue;
            }

            $responseModel = $this->getDefinitionByRef(
                $path['get']['responses']['200']['schema']['items']['$ref']
            );

            if (!isset($responseModel['properties']) || is_null($responseModel['properties'])) {
                continue;
            }

            $path['get']['parameters'] = $this->appendPropertiesIntoParameters(
                $path['get']['parameters'],
                $responseModel['properties']
            );

            $path['get']['parameters'][]  = [
                'name' => '_pagination',
                'in' => 'query',
                'required' => false,
                'type' => 'boolean'
            ];
        }

        return $paths;
    }

    /**
     * @param \ArrayObject $responses
     * @return string
     */
    private function cleanRef(string $name)
    {
        $segments = explode('/', $name);

        return end($segments);
    }

    private function getDefinitionByRef(string $ref)
    {
        $model = $this->cleanRef($ref);

        return $this->definitions[$model];
    }

    private function appendPropertiesIntoParameters(array $parameters, array $properties, $prefix = '')
    {
        foreach ($properties as $name => $values) {
            if ($name === 'id') {
                continue;
            }

            if (array_key_exists('$ref', $values)) {
                $responseModel = $this->getDefinitionByRef($values['$ref']);
                $parameters = $this->appendPropertiesIntoParameters(
                    $parameters,
                    $responseModel['properties'],
                    $name . '.'
                );
                continue;
            }

            $parameterExists = array_filter($parameters, function ($item) use ($prefix, $name) {
                return $item['name'] === ($prefix . $name);
            });

            if (!empty($parameterExists)) {
                continue;
            }

            if (!isset($values['type']) || is_null($values['type'])) {
                continue;
            }

            $parameters[] = [
                'name' => $prefix . $name,
                'in' => 'query',
                'required' => false,
                'type' => $values['type']
            ];
        }

        return $parameters;
    }
}
