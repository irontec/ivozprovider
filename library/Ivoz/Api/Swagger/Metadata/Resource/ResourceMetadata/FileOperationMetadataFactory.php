<?php

namespace Ivoz\Api\Swagger\Metadata\Resource\ResourceMetadata;

use ApiPlatform\Core\Metadata\Resource\Factory\ResourceMetadataFactoryInterface;
use ApiPlatform\Core\Metadata\Resource\ResourceMetadata;
use Doctrine\Common\Util\Inflector;
use Ivoz\Api\Symfony\Controller\DownloadAction;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;

class FileOperationMetadataFactory implements ResourceMetadataFactoryInterface
{
    /**
     * @var ResourceMetadataFactoryInterface
     */
    private $decorated;

    public function __construct(
        ResourceMetadataFactoryInterface $decorated
    ) {
        $this->decorated = $decorated;
    }

    /**
     * @inheritdoc
     */
    public function create(string $resourceClass): ResourceMetadata
    {
        $resourceMetadata = $this->decorated->create($resourceClass);
        $isEntity = in_array(EntityInterface::class, class_implements($resourceClass));
        if (!$isEntity) {
            return $resourceMetadata;
        }

        $reflectionClass = new \ReflectionClass($resourceClass);
        $resourceInstance = $reflectionClass->newInstanceWithoutConstructor();
        if (!($resourceInstance instanceof FileContainerInterface)) {
            return $resourceMetadata;
        }

        $resourceMetadata = $this->allowFileUpload(
            $resourceMetadata,
            $resourceInstance->getFileObjects(
                FileContainerInterface::UPDALOADABLE_FILE
            )
        );

        return $this->allowFileDownload(
            $resourceMetadata,
            $resourceInstance->getFileObjects(
                FileContainerInterface::DOWNLOADABLE_FILE
            )
        );
    }

    private function allowFileUpload(ResourceMetadata $resourceMetadata, array $fileObjects)
    {
        $itemOperations = $resourceMetadata->getItemOperations();
        $collectionOperations = $resourceMetadata->getCollectionOperations();

        if (!empty($itemOperations) && isset($itemOperations['put'])) {
            if (!isset($itemOperations['put']['swagger_context']['upload_parameters'])) {
                $itemOperations['put']['swagger_context']['upload_parameters'] = [];
            }
            foreach ($fileObjects as $fileObject) {
                $itemOperations['put']['swagger_context']['upload_parameters'][] = [
                    'name' => $fileObject,
                    'in' => 'formData',
                    'type' => 'file',
                    'required' => false
                ];
            }

            $resourceMetadata = $resourceMetadata->withItemOperations($itemOperations);
        }

        if (!empty($collectionOperations) && isset($collectionOperations['post'])) {
            if (!isset($collectionOperations['post']['swagger_context']['upload_parameters'])) {
                $collectionOperations['post']['swagger_context']['upload_parameters'] = [];
            }
            foreach ($fileObjects as $fileObject) {
                $collectionOperations['post']['swagger_context']['upload_parameters'][] = [
                    'name' => $fileObject,
                    'in' => 'formData',
                    'type' => 'file',
                    'required' => false
                ];
            }

            $resourceMetadata = $resourceMetadata->withCollectionOperations($collectionOperations);
        }

        return $resourceMetadata;
    }

    private function allowFileDownload(ResourceMetadata $resourceMetadata, array $fileObjects)
    {
        $itemOperations = $resourceMetadata->getItemOperations();

        $getItemOperations = array_filter(
            $itemOperations,
            function (array $operation) {
                $method = $operation['method'] ?? null;

                return strtolower($method) === 'get';
            }
        );

        if (empty($getItemOperations)) {
            return $resourceMetadata;
        }

        foreach ($fileObjects as $fileObject) {
            $entityPath = $this->pluralize(
                $resourceMetadata->getShortName()
            );

            $path = sprintf(
                '/%s/{id}/%s',
                $entityPath,
                strtolower($fileObject)
            );

            $description = sprintf(
                '%s %s',
                $resourceMetadata->getShortName(),
                lcfirst($fileObject)
            );

            $operation = [
                'method' => 'GET',
                'path' => $path,
                'controller' => DownloadAction::class,
                'defaults' => [
                    '_api_resource_class_attribute' => $fileObject,
                    '_api_receive' => true
                ],
                'swagger_context' => [
                    'produces' => ['application/octet-stream'],
                    'responses' => [
                        '200' => [
                            'description' => $description,
                        ],
                        '404' => [
                            'description' => 'Resource not found'
                        ]
                    ]
                ]
            ];

            $operationName = sprintf(
                '/%s_%s',
                strtolower($resourceMetadata->getShortName()),
                strtolower($fileObject)
            );

            $itemOperations[$operationName] = $operation;
        }

        return $resourceMetadata->withItemOperations($itemOperations);
    }


    /**
     * Transforms a given string to a tableized, pluralized string.
     */
    private function pluralize(string $name): string
    {
        $name = Inflector::tableize($name);

        return Inflector::pluralize($name);
    }
}
