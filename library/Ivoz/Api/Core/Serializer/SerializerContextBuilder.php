<?php

namespace Ivoz\Api\Core\Serializer;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Serializer\SerializerContextBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

final class SerializerContextBuilder implements SerializerContextBuilderInterface
{
    private $decorated;
    private $resourceMetadataFactory;

    public function __construct(ResourceMetadataFactoryInterface $resourceMetadataFactory, SerializerContextBuilderInterface $decorated)
    {
        $this->decorated = $decorated;
        $this->resourceMetadataFactory = $resourceMetadataFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createFromRequest(Request $request, bool $normalization, array $attributes = null): array
    {
        $context = $this->decorated->createFromRequest(
            $request,
            $normalization,
            $attributes
        );

        $context = $this->operationTypeOverwrite(
            $context,
            $attributes
        );

        return $context;
    }

    private function operationTypeOverwrite(array $context, array $attributes = null)
    {
        $resourceMetadata = $this->resourceMetadataFactory->create($attributes['resource_class']);

        $key = 'operation_normalization_context';
        $isCollection = isset($attributes['collection_operation_name']);
        $isSubresource = isset($attributes['subresource_operation_name']);

        if ($isCollection || $isSubresource) {
            $operationKey = $isCollection ? 'collection_operation_name' : 'subresource_operation_name';
            $contextOverwrite = $resourceMetadata->getCollectionOperationAttribute($attributes[$operationKey], $key, null, true);
        } else {
            $operationKey = 'item_operation_name';
            $contextOverwrite = $resourceMetadata->getItemOperationAttribute($attributes[$operationKey], $key, null, true);
        }

        if (!is_null($contextOverwrite)) {
            $context['operation_normalization_context'] = $contextOverwrite;
        }

        return $context;
    }
}
