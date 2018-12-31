<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Exception\ResourceClassNotFoundException;
use Doctrine\Common\Persistence\ManagerRegistry;
use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

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
            $resourceClassSegments = explode('\\', $resourceClass);

            $resourceMetadata = $this->setEntityOperationMetadata(
                $resourceMetadata,
                $resourceClassSegments[1]
            );

            $reflectionClass = new \ReflectionClass($resourceClass);
            $resourceInstance = $reflectionClass->newInstanceWithoutConstructor();
            if ($resourceInstance instanceof FileContainerInterface) {
                $fileObjects = $resourceInstance->getFileObjects();
                $resourceMetadata = $this->allowFileUpload(
                    $resourceMetadata,
                    $fileObjects
                );
            }

            return $resourceMetadata;
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

    private function allowFileUpload(ResourceMetadata $resourceMetadata, array $fileObjects)
    {
        $itemOperations = $resourceMetadata->getItemOperations();
        $collectionOperations = $resourceMetadata->getCollectionOperations();

        if (!empty($itemOperations) && isset($itemOperations['put'])) {
            if (!isset($itemOperations['put']['swagger_context']['_parameters'])) {
                $itemOperations['put']['swagger_context']['upload_parameters'] = [];
            }
            foreach ($fileObjects as $fileObject) {
                $itemOperations['put']['swagger_context']['upload_parameters'][] = [
                    'name' => $fileObject,
                    'in' => 'path',
                    'type' => 'file',
                    'required' => false
                ];
            }

            $resourceMetadata = $resourceMetadata->withItemOperations($itemOperations);
        }

        if (!empty($collectionOperations) && isset($collectionOperations['post'])) {
            if (!isset($collectionOperations['post']['swagger_context']['_parameters'])) {
                $collectionOperations['post']['swagger_context']['upload_parameters'] = [];
            }
            foreach ($fileObjects as $fileObject) {
                $collectionOperations['post']['swagger_context']['upload_parameters'][] = [
                    'name' => $fileObject,
                    'in' => 'path',
                    'type' => 'file',
                    'required' => false
                ];
            }

            $resourceMetadata = $resourceMetadata->withCollectionOperations($collectionOperations);
        }

        return $resourceMetadata;
    }

    /**
     * @param ResourceMetadata $resourceMetadata
     * @return ResourceMetadata
     */
    private function setEntityOperationMetadata(ResourceMetadata $resourceMetadata, string $tag = ''): ResourceMetadata
    {
        $defaultFormats = [
            'application/ld+json',
            'application/json'
        ];

        $itemOperations = $resourceMetadata->getItemOperations();
        $defaultItemOperations = [
            'get' => [
                'method' => 'GET',
                'normalization_context' => [
                    'groups' => [
                        DataTransferObjectInterface::CONTEXT_DETAILED
                    ]
                ],
                'swagger_context' => [
                    'produces' => $defaultFormats,
                ]
            ],
            'put' => [
                'method' => 'PUT',
                'swagger_context' => [
                    'consumes' => $defaultFormats,
                    'produces' => $defaultFormats,
                ]
            ],
            'delete' => [
                'method' => 'DELETE'
            ]
        ];
        $defaultItemOperations = array_filter(
            $defaultItemOperations,
            function ($key) use ($itemOperations) {
                return array_key_exists($key, $itemOperations);
            },
            ARRAY_FILTER_USE_KEY
        );

        $itemOperations = array_replace_recursive(
            $defaultItemOperations,
            $itemOperations
        );
        $itemOperations = array_filter($itemOperations, function ($value) {
            return !is_null($value);
        });
        $resourceMetadata = $resourceMetadata->withItemOperations($itemOperations);

        $collectionOperations = $resourceMetadata->getCollectionOperations();
        $defaultCollectionOperations = [
            'get' => [
                'method' => 'GET',
                'normalization_context' => [
                    'groups' => [
                        DataTransferObjectInterface::CONTEXT_COLLECTION
                    ]
                ],
                'swagger_context' => [
                    'produces' => $defaultFormats,
                ]
            ],
            'post' => [
                'method' => 'POST',
                'swagger_context' => [
                    'consumes' => $defaultFormats,
                    'produces' => $defaultFormats,
                ]
            ]
        ];
        $defaultCollectionOperations = array_filter(
            $defaultCollectionOperations,
            function ($key) use ($collectionOperations) {
                return array_key_exists($key, $collectionOperations);
            },
            ARRAY_FILTER_USE_KEY
        );

        $collectionOperations = array_replace_recursive(
            $defaultCollectionOperations,
            $collectionOperations
        );
        $collectionOperations = array_filter($collectionOperations, function ($value) {
            return !is_null($value);
        });
        $resourceMetadata = $resourceMetadata->withCollectionOperations($collectionOperations);

        return $this->setOperationTags(
            $resourceMetadata,
            $tag ?? self::ENTITY_TAG
        );
    }

    /**
     * @param ResourceMetadata $resourceMetadata
     * @param string $tag
     * @return ResourceMetadata
     */
    private function setOperationTags(ResourceMetadata $resourceMetadata, string $tag): ResourceMetadata
    {
        $operations = [];
        foreach ($resourceMetadata->getItemOperations() as $key => $operation) {
            if (!isset($operation['swagger_context']['tags'])) {
                $operation['swagger_context'] = $operation['swagger_context'] ?? [];
                $operation['swagger_context']['tags'] = [$tag];
            }
            $operations[$key] = $operation;
        }
        $resourceMetadata = $resourceMetadata->withItemOperations($operations);

        $operations = [];
        foreach ($resourceMetadata->getCollectionOperations() as $key => $operation) {
            if (!isset($operation['swagger_context']['tags'])) {
                $operation['swagger_context'] = $operation['swagger_context'] ?? [];
                $operation['swagger_context']['tags'] = [$tag];
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
