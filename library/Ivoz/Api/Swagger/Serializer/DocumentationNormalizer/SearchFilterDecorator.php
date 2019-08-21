<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\PropertyInfo\Type;

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
        }

        return $paths;
    }

    /**
     * @param string $name
     * @return string | null
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
        $propertyParameters = array_filter(
            $parameters,
            function (array $item) {
                $name = $item['name'] ?? '';
                return $name[0] !== '_';
            }
        );

        if (empty($propertyParameters)) {
            return $parameters;
        }

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

            $skip =
                !isset($values['type'])
                || is_null($values['type'])
                || $values['type'] === Type::BUILTIN_TYPE_ARRAY;

            if ($skip) {
                continue;
            }

            $parameters[] = [
                'name' => $prefix . $name,
                'in' => 'query',
                'required' => false,
                'type' => $values['type']
            ];
        }

        uasort(
            $parameters,
            function (array $item1, array $item2) {
                $str1 = $item1['name'] ?? '';
                $str2 = $item2['name'] ?? '';

                if ($str1[0] === '_' && $str2[0] !== '_') {
                    return 1;
                }

                if ($str1[0] !== '_' && $str2[0] === '_') {
                    return -1;
                }

                $isOrderAttribute1 = strpos($str1, '_order') === 0;
                $isOrderAttribute2 = strpos($str2, '_order') === 0;

                if (!$isOrderAttribute1 && $isOrderAttribute2) {
                    return 1;
                }

                if ($isOrderAttribute1 && !$isOrderAttribute2) {
                    return -1;
                }

                return strnatcmp($str1, $str2);
            }
        );

        return array_values(
            $parameters
        );
    }
}
