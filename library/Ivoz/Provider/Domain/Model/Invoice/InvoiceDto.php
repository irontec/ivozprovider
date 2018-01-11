<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

class InvoiceDto extends InvoiceDtoAbstract
{
    private $pdfPath;

    public function getFileObjects()
    {
        return [
            'pdf'
        ];
    }

    /**
     * @return self
     */
    public function setPdfPath(string $path = null)
    {
        $this->pdfPath = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getPdfPath()
    {
        return $this->pdfPath;
    }
}


