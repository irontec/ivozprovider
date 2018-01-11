<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class OperationMetadataFactory implements ResourceMetadataFactoryInterface
{
    private $decorated;

    public function __construct(ResourceMetadataFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $resourceMetadata = $this->decorated->create($resourceClass);
        $isEntity = in_array(EntityInterface::class, class_implements($resourceClass));
        if ($isEntity) {

            $resourceMetadata = $resourceMetadata->withItemOperations([
                'get' => [
                    'method' => 'GET',
                    'normalization_context' => [
                        'groups' => [
                            DataTransferObjectInterface::CONTEXT_DETAILED
                        ]
                    ]
                ],
                'put' => [
                    'method' => 'PUT',
                ],
                'delete' => [
                    'method' => 'DELETE'
                ]
            ]);
            $resourceMetadata = $resourceMetadata->withCollectionOperations([
                'get' => [
                    'method' => 'GET',
                    'normalization_context' => [
                        'groups' => [
                            DataTransferObjectInterface::CONTEXT_COLLECTION
                        ]
                    ]
                ],
                'post' => [
                    'method' => 'POST'
                ]
            ]);

        } else {

            $classSegments = array_reverse(explode("\\", $resourceClass));
            $resourceMetadata = $resourceMetadata->withShortName(
                $classSegments[1] . '_' . $classSegments[0]
            );
            $resourceMetadata = $resourceMetadata->withItemOperations([]);
            $resourceMetadata = $resourceMetadata->withCollectionOperations([]);
        }

        return $resourceMetadata;
    }
}