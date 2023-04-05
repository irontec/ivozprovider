<?php

namespace Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class InvoiceDto extends InvoiceDtoAbstract
{
    /** @var ?string */
    private $pdfPath;

    /**
     * @var ?string
     * @AttributeDefinition(
     *     type="string",
     *     description="Invoice currency"
     * )
     */
    private $currency;

    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($role === 'ROLE_SUPER_ADMIN') {
            return [
                'id' => 'id',
                'number' => 'number',
            ];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'number' => 'number',
                'inDate' => 'inDate',
                'outDate' => 'outDate',
                'total' => 'total',
                'taxRate' => 'taxRate',
                'totalWithTax' => 'totalWithTax',
                'status' => 'status',
                'pdf' => [
                    'fileSize',
                    'mimeType',
                    'baseName',
                ],
                'invoiceTemplateId' => 'invoiceTemplate',
                'companyId' => 'company',
                'schedulerId' => 'scheduler',
                'currency' => 'currency',
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
            $response['currency'] = 'currency';
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['total']);
            unset($response['status']);
            unset($response['invoiceTemplateId']);
            unset($response['companyId']);
            unset($response['schedulerId']);
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['currency'] = $this->getCurrency();

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    public function getFileObjects(): array
    {
        return [
            'pdf'
        ];
    }

    public function setPdfPath(string $path = null): self
    {
        $this->pdfPath = $path;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getPdfPath()
    {
        return $this->pdfPath;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }
}
