<?php

namespace Controller\Provider;

use Ivoz\Provider\Application\Service\Recording\ZipRecordingFiles;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class RecordedFilesZipAction
{
    public function __construct(
        private ZipRecordingFiles $zipRecordingFiles
    ) {
    }

    public function __invoke(Request $request): BinaryFileResponse
    {
        $ids = explode(
            ',',
            (string) $request->query->get('_recordingIds')
        );

        $zipFilePath = $this
            ->zipRecordingFiles
            ->execute($ids);

        // This should return the file to the browser as response
        $response = new BinaryFileResponse($zipFilePath);
        $response
            ->headers
            ->set(
                'Content-Type',
                'application/zip'
            );

        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'recordedFile'
        );

        return $response;
    }
}
