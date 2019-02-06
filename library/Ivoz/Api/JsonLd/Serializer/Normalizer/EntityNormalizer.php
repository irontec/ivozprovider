<?php

namespace Ivoz\Api\JsonLd\Serializer\Normalizer;

use ApiPlatform\Core\Api\IriConverterInterface;
use ApiPlatform\Core\Api\ResourceClassResolverInterface;
use ApiPlatform\Core\JsonLd\ContextBuilderInterface;
use ApiPlatform\Core\JsonLd\Serializer\JsonLdContextTrait;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use Ivoz\Api\Entity\Serializer\Normalizer\DateTimeNormalizer;
use Ivoz\Api\Json\Serializer\Normalizer\EntityNormalizer as JsonEntityNormalizer;
use Ivoz\Api\Entity\Metadata\Property\Factory\PropertyNameCollectionFactory;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\DtoAssembler;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Based on ApiPlatform\Core\JsonLd\Serializer\ItemNormalizer
 */
class EntityNormalizer extends JsonEntityNormalizer implements NormalizerInterface
{
    use JsonLdContextTrait;

    const FORMAT = 'jsonld';

    /**
     * @var IriConverterInterface
     */
    protected $iriConverter;

    /**
     * @var ContextBuilderInterface
     */
    private $contextBuilder;

    public function __construct(
        ResourceMetadataFactoryInterface $resourceMetadataFactory,
        IriConverterInterface $iriConverter,
        ResourceClassResolverInterface $resourceClassResolver,
        ContextBuilderInterface $contextBuilder,
        DtoAssembler $dtoAssembler,
        DateTimeNormalizer $dateTimeNormalizer,
        PropertyNameCollectionFactory $propertyNameCollectionFactory
    ) {
        $this->iriConverter = $iriConverter;
        $this->contextBuilder = $contextBuilder;

        return parent::__construct(
            $resourceMetadataFactory,
            $resourceClassResolver,
            $contextBuilder,
            $dtoAssembler,
            $dateTimeNormalizer,
            $propertyNameCollectionFactory
        );
    }


    /**
     * @param DataTransferObjectInterface $dto
     * @param array $context
     * @param $isSubresource
     * @param $depth
     * @param $resourceClass
     * @param $resourceMetadata
     * @return array
     */
    protected function normalizeDto(
        $dto,
        array $context,
        $isSubresource,
        $depth,
        $resourceClass,
        $resourceMetadata
    ): array {
        $data = $this->addJsonLdContext(
            $this->contextBuilder,
            $resourceClass,
            $context
        );

        // Use resolved resource class instead of given resource class to support multiple inheritance child types
        $context['resource_class'] = $resourceClass;

        try {
            $context['iri'] = $this
                ->iriConverter
                ->getItemIriFromResourceClass(
                    $resourceClass,
                    ['id' => $dto->getId()]
                );
        } catch (\Exception $e) {
            // Do nothing, entity without endpoints
        }

        $rawData = parent::normalizeDto(...func_get_args());

        if (isset($context['iri'])) {
            $data['@id'] = $context['iri'];
        }
        $data['@type'] = $resourceMetadata->getIri() ?: $resourceMetadata->getShortName();

        return $data + $rawData;
    }
}
