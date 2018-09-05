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
}
