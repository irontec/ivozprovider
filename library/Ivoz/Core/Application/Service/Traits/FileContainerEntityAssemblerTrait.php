<?php

namespace Ivoz\Core\Application\Service\Traits;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverCollection;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;
use Ivoz\Core\Application\Service\StoragePathResolverInterface;

trait FileContainerEntityAssemblerTrait
{
    /**
     * @var StoragePathResolverCollection
     */
    protected $storagePathResolver;

    protected function getPathResolver($objName, $originalFileName = null): StoragePathResolverInterface
    {
        $pathResolver = $this
            ->storagePathResolver
            ->getPathResolver($objName);

        if ($originalFileName) {
            $pathResolver->setOriginalFileName($originalFileName);
        }

        return $pathResolver;
    }

    /**
     * @return void
     */
    public function handleEntityFiles(
        FileContainerInterface $entity,
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        foreach ($entity->getFileObjects() as $fieldName) {
            $pathGetter = 'get'. ucFirst($fieldName) .'Path';
            $baseNameGetter = 'get'. ucFirst($fieldName) .'BaseName';
            $tmpFilePath = $dto->{$pathGetter}();
            $baseName = $dto->{$baseNameGetter}();

            $fileHasChanged = $this->fileHasChanged(
                $entity,
                $fieldName,
                $baseName,
                $tmpFilePath
            );

            if (!$fileHasChanged) {
                continue;
            }

            $this->handleFile(
                $dto,
                $entity,
                $fieldName,
                $fkTransformer
            );
        }
    }

    /**
     * @param EntityInterface $entity
     * @param string $fieldName
     * @param string|null $tmpFilePath
     * @return bool
     */
    protected function fileHasChanged(
        EntityInterface $entity,
        string $fieldName,
        string $baseName = null,
        string $tmpFilePath = null
    ) {
        if ($tmpFilePath && !$entity->getId()) {
            return true;
        }

        if (!$tmpFilePath) {
            return false;
        }

        $currentFile = $this->getFilePath(
            $entity,
            $fieldName,
            $baseName
        );

        return $tmpFilePath !== $currentFile;
    }

    /**
     * @param EntityInterface $entity
     * @param string $fieldName
     * @param string $baseName
     * @return string
     */
    protected function getFilePath(
        EntityInterface $entity,
        string $fieldName,
        string $baseName = null
    ) {
        return $this
            ->getPathResolver($fieldName, $baseName)
            ->getFilePath($entity);
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     * @param string $fldName
     * @param \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function handleFile(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        $fldName,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        if (!$entity instanceof FileContainerInterface) {
            throw new \InvalidArgumentException(
                'Entity was expected to be instanceof of FileContainerInterface.'
            );
        }

        $this->updateDtoMetadata(
            $dto,
            $fldName
        );

        $entity->updateFromDto(
            $dto,
            $fkTransformer
        );

        $pathGetter = 'get' . ucFirst($fldName) . 'Path';
        $baseNameGetter = 'get' . ucFirst($fldName) . 'BaseName';
        $baseName = $dto->{$baseNameGetter}();

        $prevFilePath = $this->getFilePath(
            $entity,
            $fldName,
            $entity->getInitialValue(lcfirst($fldName) . 'BaseName')
        );
        $tmpFilepath = $dto->{$pathGetter}();


        /** @var FileContainerInterface $entity */
        $entity->addTmpFile(
            $fldName,
            new TempFile(
                $this->getPathResolver($fldName, $baseName),
                $tmpFilepath,
                $prevFilePath
            )
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param string $fieldName
     *
     * @throws \Exception
     *
     * @return void
     */
    protected function updateDtoMetadata(
        DataTransferObjectInterface $dto,
        $fieldName
    ) {
        $pathGetter = 'get'. $fieldName .'Path';
        $sizeSetter = 'set'. $fieldName .'FileSize';
        $mimeSetter = 'set'. $fieldName .'MimeType';
        $baseNameGetter = 'get'. $fieldName .'BaseName';
        $baseNameSetter = 'set'. $fieldName .'BaseName';
        $newFilePath = $dto->{$pathGetter}();

        /** Set null values if file has been removed */
        $fileSize = null;
        $mimeType = null;
        $baseName = null;

        if ($newFilePath && !file_exists($newFilePath)) {
            throw new \Exception('File not found: ' . $newFilePath, 2000);
        }

        if (file_exists($newFilePath)) {
            $fileSize = filesize($newFilePath);
            $finfo = new \finfo(FILEINFO_MIME);
            if ($finfo) {
                $mimeType = $finfo->file($newFilePath);
            }
            $baseName = $dto->{$baseNameGetter}();
        }

        $dto->{$baseNameSetter}(
            $baseName
        );
        $dto->{$sizeSetter}(
            $fileSize
        );
        $dto->{$mimeSetter}(
            $mimeType
        );
    }
}
