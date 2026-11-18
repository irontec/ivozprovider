<?php

declare(strict_types=1);

namespace Service;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Contact\ContactDto;
use Ivoz\Provider\Domain\Model\Contact\ContactInterface;
use Ivoz\Provider\Domain\Service\Contact\CsvRowFormatter;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ContactCsvNormalizer implements NormalizerInterface
{
    public function __construct(
        private NormalizerInterface $decoratedNormalizer,
        private CsvRowFormatter $csvRowFormatter,
        private EntityTools $entityTools
    ) {
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $this
            ->decoratedNormalizer
            ->supportsNormalization($data, $format);
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        if ($object instanceof ContactInterface) {
            $object = $this->entityTools->entityToDto($object);
        }

        if (!$object instanceof ContactDto) {
            return $this
                ->decoratedNormalizer
                ->normalize($object, $format, $context);
        }

        return $this->csvRowFormatter->execute($object);
    }
}
