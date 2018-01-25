<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\Common\Persistence\ManagerRegistry;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class OperationMetadataFactory implements ResourceMetadataFactoryInterface
{
    const ENTITY_TAG = 'Raw';

    /**
     * @var ResourceMetadataFactoryInterface
     */
    private $decorated;

    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(
        ResourceMetadataFactoryInterface $decorated,
        ManagerRegistry $managerRegistry
    ) {
        $this->decorated = $decorated;
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $resourceMetadata = $this->decorated->create($resourceClass);
        $isEntity = in_array(EntityInterface::class, class_implements($resourceClass));
        if ($isEntity) {
            return $this->setEntityOperationMetadata($resourceMetadata);
        }

        $manager = $this->managerRegistry->getManagerForClass($resourceClass);
        if (!$manager) {
            return $this->setCustomOperationMetadata($resourceClass, $resourceMetadata);
        }

        $doctrineClassMetadata = $manager->getClassMetadata($resourceClass);
        if ($doctrineClassMetadata->isEmbeddedClass) {
            return $this->setEmbeddableOperationMetadata($resourceClass, $resourceMetadata);
        }

        throw new ResourceClassNotFoundException($resourceClass);
    }

    /**
     * @param ResourceMetadata $resourceMetadata
     * @return ResourceMetadata
     */
    private function setEntityOperationMetadata(ResourceMetadata $resourceMetadata): ResourceMetadata
    {
        $itemOperations = array_replace_recursive(
            [
                'get' => [
                    'method' => 'GET',
                    'normalization_context' => [
                        'groups' => [
                            DataTransferObjectInterface::CONTEXT_DETAILED
                        ]
                    ]
                ]
            ],
            $resourceMetadata->getItemOperations()
        );
        $resourceMetadata = $resourceMetadata->withItemOperations($itemOperations);

        $collectionOperations = array_replace_recursive(
            [
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
            ],
            $resourceMetadata->getCollectionOperations()

        );
        $resourceMetadata = $resourceMetadata->withCollectionOperations($collectionOperations);
        return $this->setOperationtags($resourceMetadata, self::ENTITY_TAG);
    }

    /**
     * @param ResourceMetadata $resourceMetadata
     * @param string $tag
     * @return ResourceMetadata
     */
    private function setOperationtags(ResourceMetadata $resourceMetadata, string $tag): ResourceMetadata
    {
        $operations = [];
        foreach ($resourceMetadata->getItemOperations() as $key => $operation) {
            if (!isset($operation['swagger_context']['tags'])) {
                $operation['swagger_context'] = [
                    'tags' => [$tag]
                ];
            }
            $operations[$key] = $operation;
        }
        $resourceMetadata = $resourceMetadata->withItemOperations($operations);

        $operations = [];
        foreach ($resourceMetadata->getCollectionOperations() as $key => $operation) {
            if (!isset($operation['swagger_context']['tags'])) {
                $operation['swagger_context'] = [
                    'tags' => [$tag]
                ];
            }
            $operations[$key] = $operation;
        }

        return $resourceMetadata->withCollectionOperations($operations);
    }

    /**
     * @param string $resourceClass
     * @param ResourceMetadata $resourceMetadata
     * @return ResourceMetadata
     */
    private function setEmbeddableOperationMetadata(string $resourceClass, ResourceMetadata $resourceMetadata): ResourceMetadata
    {
        $classSegments = array_reverse(explode("\\", $resourceClass));
        $resourceMetadata = $resourceMetadata->withShortName(
            $classSegments[1] . '_' . $classSegments[0]
        );
        $resourceMetadata = $resourceMetadata->withItemOperations([]);
        $resourceMetadata = $resourceMetadata->withCollectionOperations([]);

        return $resourceMetadata;
    }

    /**
     * @param string $resourceClass
     * @param ResourceMetadata $resourceMetadata
     * @return ResourceMetadata
     */
    private function setCustomOperationMetadata(string $resourceClass, ResourceMetadata $resourceMetadata): ResourceMetadata
    {
        $classSegments = explode("\\", $resourceClass);
        $resourceMetadata = $resourceMetadata->withShortName(
            end($classSegments)
        );

        return $resourceMetadata;
    }
}