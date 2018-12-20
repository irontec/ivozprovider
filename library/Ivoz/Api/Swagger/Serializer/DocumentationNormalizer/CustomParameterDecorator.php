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
                $path->exchangeArray($pathArray);
            }
        }

        return $response;
    }
}
