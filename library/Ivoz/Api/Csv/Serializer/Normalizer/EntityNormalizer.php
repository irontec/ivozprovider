<?php

namespace Ivoz\Api\Csv\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Ivoz\Api\Json\Serializer\Normalizer\EntityNormalizer as JsonEntityNormalizer;

/**
 * Based on ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer
 */
class EntityNormalizer extends JsonEntityNormalizer implements NormalizerInterface
{
    const FORMAT = 'csv';



    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $response = parent::normalize(...func_get_args());
        foreach ($response as $key => $value) {

            if (!is_object($value)) {
                continue;
            }

            $class = get_class($value);
            switch ($class) {
                case 'DateTime':
                    $value = $value->format('Y-m-d H:i:s');
                    break;
            }

            $response[$key] = $value;
        }

        return $response;
    }
}