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

        $entity->addTmpFile(
            new TempFile(
                $dto->getLogoPath(),
                $this->logoPathResolver
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

        if (!$this->hasChanged($id, $filePath)) {
            return false;
        }

        if (empty($filePath) or !file_exists($filePath)) {
            throw new \Exception('File not found: ' . $filePath);
        }

        $dto->{$sizeSetter}(
            filesize($filePath)
        );

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