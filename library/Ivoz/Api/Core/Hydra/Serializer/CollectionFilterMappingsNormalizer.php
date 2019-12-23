<?php

namespace Ivoz\Api\Core\Hydra\Serializer;

use ApiPlatform\Core\Api\FilterLocatorTrait;
use ApiPlatform\Core\JsonLd\Serializer\JsonLdContextTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class CollectionFilterMappingsNormalizer
 * @package Ivoz\Api\Core\Hydra\Serializer
 *
 * Removes hydra:search->hydra:mapping values
 */
final class CollectionFilterMappingsNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use JsonLdContextTrait;
    use FilterLocatorTrait;

    private $collectionNormalizer;


    /**
     * CollectionFiltersMappingNormalizer constructor.
     * @param NormalizerInterface $collectionNormalizer
     */
    public function __construct(NormalizerInterface $collectionNormalizer)
    {
        $this->collectionNormalizer = $collectionNormalizer;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this->collectionNormalizer->supportsNormalization($data, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->collectionNormalizer->normalize($object, $format, $context);

        if (isset($data['hydra:search']) && isset($data['hydra:search']['hydra:mapping'])) {
            unset($data['hydra:search']['hydra:mapping']);
        }

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function setNormalizer(NormalizerInterface $normalizer)
    {
        if ($this->collectionNormalizer instanceof NormalizerAwareInterface) {
            $this->collectionNormalizer->setNormalizer($normalizer);
        }
    }
}
