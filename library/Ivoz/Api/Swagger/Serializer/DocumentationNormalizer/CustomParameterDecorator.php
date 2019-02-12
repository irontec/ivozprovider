<?php

namespace Ivoz\Api\Swagger\Serializer\DocumentationNormalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class CustomParameterDecorator implements NormalizerInterface
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

        foreach ($response['paths'] as $paths) {
            foreach ($paths as $key => $path) {
                $pathArray = $path->getArrayCopy();
                if (!array_key_exists('upload_parameters', $pathArray)) {
                    continue;
                }

                array_push(
                    $pathArray['parameters'],
                    ...$pathArray['upload_parameters']
                );
                unset($pathArray['upload_parameters']);
                $pathArray['consumes'][] = 'multipart/form-data';
                foreach ($pathArray['parameters'] as $key => $parameter) {
                    if ($parameter['in'] === 'body') {
                        $parameter['in'] = 'formData';
                    }

                    if (isset($parameter['schema'])) {
                        // Complex types are not supported with formData parameters yet
                        // @see https://github.com/swagger-api/swagger-editor/issues/1156
                        unset($parameter['schema']);
                        $parameter['type'] = 'string';
                    }

                    $pathArray['parameters'][$key] = $parameter;
                }

                $path->exchangeArray($pathArray);
            }
        }

        return $response;
    }
}
