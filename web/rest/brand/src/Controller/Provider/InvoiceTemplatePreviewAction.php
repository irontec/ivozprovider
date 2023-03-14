<?php

namespace Controller\Provider;

use Ivoz\Provider\Domain\Service\InvoiceTemplate\InvoiceTemplateGenerator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class InvoiceTemplatePreviewAction
{
    public function __construct(
        private InvoiceTemplateGenerator $invoiceTemplateGenerator
    ) {
    }

    public function __invoke(Request $request): Response
    {
        $invoiceTemplateId = (int)$request->attributes->get('id');

        $invoiceTemplate = $this
            ->invoiceTemplateGenerator
            ->execute($invoiceTemplateId);

        if (is_null($invoiceTemplate)) {
            return new Response('Invoice Template not found', 404);
        }

        return new Response($invoiceTemplate, 200);
    }
}
