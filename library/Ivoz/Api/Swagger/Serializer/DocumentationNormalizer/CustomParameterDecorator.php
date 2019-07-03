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
                $pathArray = $this->setUploadParams(
                    $path->getArrayCopy()
                );

                $pathArray = $this->setPaginationParams(
                    $pathArray
                );

                $path->exchangeArray($pathArray);
            }
        }

        return $response;
    }

    private function setUploadParams(array $pathArray): array
    {
        if (!array_key_exists('upload_parameters', $pathArray)) {
            return $pathArray;
        }

        if (empty($pathArray['upload_parameters'])) {
            unset($pathArray['upload_parameters']);

            return $pathArray;
        }

        array_push(
            $pathArray['parameters'],
            ...$pathArray['upload_parameters']
        );
        unset($pathArray['upload_parameters']);
        array_unshift($pathArray['consumes'], 'multipart/form-data');
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

        return $pathArray;
    }

    private function setPaginationParams(array $pathArray): array
    {
        if (!array_key_exists('pagination_parameters', $pathArray)) {
            return $pathArray;
        }

        array_push(
            $pathArray['parameters'],
            ...$pathArray['pagination_parameters']
        );
        unset($pathArray['pagination_parameters']);

        return $pathArray;
    }
}
