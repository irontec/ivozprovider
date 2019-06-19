<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

class InvoiceDto extends InvoiceDtoAbstract
{
    private $pdfPath;


    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'number' => 'number',
                'inDate' => 'inDate',
                'outDate' => 'outDate',
                'total' => 'total',
                'totalWithTax' => 'totalWithTax',
                'status' => 'status',
                'pdf' => ['fileSize','mimeType','baseName'],
                'invoiceTemplateId' => 'invoiceTemplate',
                'companyId' => 'company'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

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
