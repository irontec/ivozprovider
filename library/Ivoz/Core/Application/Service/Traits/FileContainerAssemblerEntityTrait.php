<?php

namespace Ivoz\Core\Application\Service\Traits;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\TempFile;

trait FileContainerAssemblerEntityTrait
{
    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface $entity
     * @param $objName
     */
    protected function handleFile(
        DataTransferObjectInterface $dto,
        EntityInterface $entity,
        $objName
    ) {
        $updated = $this->updateMetadata($dto, $objName);
        if (!$updated) {
            return;
        }
        $entity->updateFromDTO($dto);

        if (!$dto->getLogoPath() && !$updated) {
            return;
        }

        if (!$dto->getLogoPath()) {

            $entity->addTmpFile(
                new TempFile(
                    $this->logoPathResolver,
                    $dto->getLogoPath()
                )
            );
            return;
        }

        $entity->addTmpFile(
            new TempFile(
                $this->logoPathResolver,
                $dto->getLogoPath()
            )
        );
    }

    /**
     * @param BrandDTO $dto
     * @throws \Exception
     * @return boolean updated
     */
    private function updateMetadata(DataTransferObjectInterface $dto, $fieldName)
    {
        $id = $dto->getId();
        $pathGetter = 'get'. $fieldName .'Path';
        $sizeSetter = 'set'. $fieldName .'FileSize';
        $mimeSetter = 'set'. $fieldName .'MimeType';

        $filePath = $dto->{$pathGetter}();
        $fileSize = null;
        $mimeType = null;

        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            $finfo = new \finfo(FILEINFO_MIME);
            if ($finfo) {
                $mimeType = $finfo->file($filePath);
            }
        }

        $dto->{$sizeSetter}(
            $fileSize
        );
        $dto->{$mimeSetter}(
            $mimeType
        );

        if (!$id) {
            return true;
        }

        if (!$this->hasChanged($id, $filePath)) {
            return false;
        }

        if ($filePath && !file_exists($filePath)) {
            throw new \Exception('File not found: ' . $filePath);
        }

        return true;
    }

    /**
     * @param $entityId
     * @param $newFilePath
     * @return bool
     */
    private function hasChanged($entityId, $newFilePath)
    {
        if (!$entityId && $newFilePath) {
            return true;
        }

        $targetFile = $this
            ->logoPathResolver
            ->getFilePath($entityId);

        if ($newFilePath !== $targetFile) {
            return true;
        }

        return false;
    }
}