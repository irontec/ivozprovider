<?php

namespace Ivoz\Provider\Domain\Model\Locution;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
 * Locution
 */
class Locution extends LocutionAbstract implements FileContainerInterface, LocutionInterface
{
    use LocutionTrait;
    use TempFileContainnerTrait {
        addTmpFile as protected _addTmpFile;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null): array
    {
        $fileObjects = [
            'OriginalFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
                FileContainerInterface::UPDALOADABLE_FILE,
            ],
            'EncodedFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
    }

    /**
     * @codeCoverageIgnore
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     *
     * @return void
     */
    public function addTmpFile(string $fldName, TempFile $file)
    {
        if ($fldName === 'OriginalFile') {
            $this->setStatus('pending');
        }
        $this->_addTmpFile($fldName, $file);
    }
}
