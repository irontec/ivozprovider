<?php

namespace spec\Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class InvoiceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ExtensionDto
     */
    protected $dto;

    function let(
        BrandInterface $brand,
        CompanyInterface $company
    ) {
        $this->dto = $dto = new InvoiceDto();
        $dto
            ->setNumber('123')
            ->setPdfFileSize(560)
            ->setPdfMimeType('')
            ->setPdfBaseName('file.pdf');

        $this->hydrate(
            $dto,
            [
                'brand' => $brand->getWrappedObject(),
                'company' => $company->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Invoice::class);
    }
}
