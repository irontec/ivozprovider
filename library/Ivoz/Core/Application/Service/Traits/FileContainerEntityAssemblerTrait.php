<?php

namespace Ivoz\Core\Application\Service\Traits;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\StoragePathResolverInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\TempFile;

trait FileContainerEntityAssemblerTrait
{
    /**
     * @var StoragePathResolverInterface[]
     */
    protected $pathResolvers = [];

    protected function setPathResolver($objName, StoragePathResolverInterface $storagePathResolver)
    {
        $this->pathResolvers[$objName] = $storagePathResolver;
    }

    protected function getPathResolver($objName, $originalFileName = null)
    {
        if (!array_key_exists($objName, $this->pathResolvers)) {
            throw new \Exception('No path resolver found for ' . $objName, 1000);
        }

        $pathResolver = $this->pathResolvers[$objName];
        if ($originalFileName) {
            $pathResolver->setOriginalFileName($originalFileName);
        }

        return $this->pathResolvers[$objName];
    }

    public function handleEntityFiles(
        EntityInterface $entity,
        DataTransferObjectInterface $dto
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

            $this->handleFile($dto, $entity, $fieldName);
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

        $currentFile = $this
            ->getPathResolver($fieldName, $baseName)
            ->getFilePath($entity);

        return $tmpFilePath !== $currentFile;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     * @param $fldName
     */
    protected function handleFile(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        $fldName
    ) {
        $this->updateMetadata($dto, $fldName);
        $entity->updateFromDTO($dto);

        $pathGetter = 'get' . ucFirst($fldName) . 'Path';
        $baseNameGetter = 'get' . ucFirst($fldName) . 'BaseName';
        $baseName = $dto->{$baseNameGetter}();

        $entity->addTmpFile(
            new TempFile(
                $this->getPathResolver($fldName, $baseName),
                $dto->{$pathGetter}()
            )
        );
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param $fieldName
     * @throws \Exception
     */
    protected function updateMetadata(
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