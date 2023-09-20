<?php

namespace Controller\Provider;

use Ivoz\Provider\Domain\Service\InvoiceTemplate\InvoiceTemplatePreviewGenerator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class InvoiceTemplatePreviewAction
{
    public function __construct(
        private InvoiceTemplatePreviewGenerator $invoiceTemplatePreviewGenerator
    ) {
    }

    public function __invoke(Request $request): BinaryFileResponse
    {
        $invoiceTemplateId = (int) $request->attributes->get('id');

        $invoicePreviewFile = $this
            ->invoiceTemplatePreviewGenerator
            ->execute($invoiceTemplateId);

        if (is_null($invoicePreviewFile)) {
            throw new NotFoundHttpException(
                'Invoice Template not found',
            );
        }

        $response = new BinaryFileResponse(
            $invoicePreviewFile
        );

        /** @var string $disposition */
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'invoice_template_preview.pdf'
        );
        $response->headers->set(
            'Content-Disposition',
            $disposition
        );

        $response->deleteFileAfterSend(true);

        return $response;
    }
}
