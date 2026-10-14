<?php

namespace Ivoz\Provider\Domain\Service\InvoiceTemplate;

/**
 * wkhtmltopdf options for rendering invoice templates
 *
 * Templates are written by brand admins, so the renderer must not
 * let them read local files nor run scripts on the platform server.
 * Local assets (brand logo) are passed as data: URIs instead.
 */
class GetInvoicePdfOptions
{
    /**
     * @return array<string, string|int|bool>
     */
    public function execute(string $header, string $footer): array
    {
        return [
            'header-html' => $header,
            'header-spacing' => 3,
            'footer-html' => $footer,
            'footer-spacing' => 3,
            'load-error-handling' => 'ignore',
            'disable-local-file-access' => true,
            'disable-javascript' => true,
        ];
    }
}
