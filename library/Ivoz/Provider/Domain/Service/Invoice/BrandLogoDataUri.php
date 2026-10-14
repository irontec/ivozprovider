<?php

namespace Ivoz\Provider\Domain\Service\Invoice;

/**
 * Embeds the brand logo in the invoice as a data: URI, so that
 * wkhtmltopdf can render it without local file access
 */
class BrandLogoDataUri
{
    public function execute(?string $logoPath, ?string $mimeType): string
    {
        if (!$logoPath || !$mimeType || !is_file($logoPath)) {
            return '';
        }

        $content = file_get_contents($logoPath);
        if ($content === false) {
            return '';
        }

        return 'data:' . $mimeType . ';base64,' . base64_encode($content);
    }
}
