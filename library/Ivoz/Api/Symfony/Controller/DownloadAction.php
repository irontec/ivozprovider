<?php

namespace Ivoz\Api\Symfony\Controller;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadAction
{
    protected $requestStack;
    protected $entityTools;
    protected $fs;

    /**
     * @var DataTransferObjectInterface
     */
    protected $dto;

    /**
     * @var string
     */
    protected $targetAttribute;

    public function __construct(
        RequestStack $requestStack,
        EntityTools $entityTools,
        Filesystem $fs
    ) {
        $this->requestStack = $requestStack;
        $this->entityTools = $entityTools;
        $this->fs = $fs;
    }

    public function __invoke()
    {
        /** @var Request $request */
        $request = $this->requestStack->getCurrentRequest();
        $reqParameters = $request->attributes;
        $entity = $request->attributes->get('data');

        if (!$entity instanceof FileContainerInterface) {
            throw new \RuntimeException(
                'Entity does not contain downloadable file attributes'
            );
        }

        $this->targetAttribute = $request->attributes->get('_api_resource_class_attribute');
        $attributeIsDownloadable = array_filter(
            $entity->getFileObjects(),
            function ($attribute) {
                return
                    strtoupper($attribute) === strtoupper($this->targetAttribute);
            }
        );

        if (empty($attributeIsDownloadable)) {
            throw new \RuntimeException(
                'Entity attribute is not downloadable'
            );
        }

        $this->dto = $this->entityTools->entityToDto($entity);

        return $this->createDownloadResponse(
            $this->getPath(),
            $this->getName(),
            $this->getMimeType()
        );
    }

    /**
     * @return string
     * @throws \RuntimeException
     */
    private function getPath(): string
    {
        $filePathGetter = 'get' . $this->targetAttribute . 'Path';
        $filePath = $this->dto->{$filePathGetter}();

        $fileExists = $this->fs->exists($filePath);
        if (!$fileExists) {
            throw new \RuntimeException(
                'File not found',
                404
            );
        };

        return $filePath;
    }

    private function getMimeType(): string
    {
        $fileMimeTypeGetter = 'get' . $this->targetAttribute . 'MimeType';

        return $this->dto->{$fileMimeTypeGetter}();
    }

    private function getName(): string
    {
        $fileBaseNameGetter = 'get' . $this->targetAttribute . 'BaseName';

        return $this->dto->{$fileBaseNameGetter}();
    }

    private function createDownloadResponse(
        string $filePath,
        string $fileName,
        string $mimeType = 'application/octet-stream',
        bool $forceDownload = true
    ): StreamedResponse {

        $stream = \fopen($filePath, 'rb');
        $response = new StreamedResponse(function () use ($stream) {
            \stream_copy_to_stream($stream, \fopen('php://output', 'wb'));
        });

        $disposition = $response->headers->makeDisposition(
            $forceDownload ? ResponseHeaderBag::DISPOSITION_ATTACHMENT : ResponseHeaderBag::DISPOSITION_INLINE,
            $fileName
        );
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', $mimeType ?: 'application/octet-stream');

        return $response;
    }
}
