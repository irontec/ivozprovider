<?php

namespace Ivoz\Provider\Application\Service\Recording;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Recording\RecordingDto;
use Ivoz\Provider\Domain\Model\Recording\RecordingInterface;
use Ivoz\Provider\Domain\Model\Recording\RecordingRepository;
use Symfony\Component\Filesystem\Filesystem;

class ZipRecordingFiles
{
    public function __construct(
        private Filesystem $fs,
        private EntityTools $entityTools,
        private RecordingRepository $recordingRepository
    ) {
    }

    /**
     * @param String[] $ids
     */
    public function execute(array $ids): string
    {
        $zip = new \ZipArchive();
        $tmpZipFile = tempnam(
            '/tmp',
            'symfony'
        );

        if (!$tmpZipFile) {
            throw new \RuntimeException('Unable to create tmp file');
        }

        $success = $zip->open(
            $tmpZipFile,
            \ZipArchive::CREATE
        );

        if (!$success) {
            throw new \Exception('Unable to open zip file');
        }

        foreach ($ids as $value) {
            /** @var RecordingInterface $recording */
            $recording = $this->recordingRepository->find((int) $value);

            /** @var RecordingDto $recordingDto */
            $recordingDto = $this->entityTools->entityToDto($recording);

            $zip->addFile(
                $this->getPath($recordingDto),
                './' . $recordingDto->getRecordedFileBaseName()
            );
        }

        $zip->close();

        return $tmpZipFile ;
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    private function getPath(RecordingDto $dto): string
    {
        $filePath = $dto->getRecordedFilePath();
        if (!$filePath) {
            throw new \RuntimeException(
                'No recorded file path found',
                404
            );
        };

        $fileExists = $this->fs->exists($filePath);
        if (!$fileExists) {
            throw new \RuntimeException(
                'File not found',
                404
            );
        };

        return $filePath;
    }
}
