<?php

namespace spec\Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class InvoiceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var InvoiceDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $brand = $this->getInstance(
            Brand::class
        );
        $brandDto = new BrandDto();

        $company = $this->getInstance(
            Company::class
        );
        $companyDto = new CompanyDto();

        $this->dto = $dto = new InvoiceDto();
        $dto
            ->setId(1)
            ->setNumber('123')
            ->setPdfFileSize(560)
            ->setPdfMimeType('')
            ->setPdfBaseName('file.pdf')
            ->setBrand($brandDto)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand],
            [$companyDto, $company],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Invoice::class);
    }


    function it_resets_calculated_values_if_base_values_have_changed()
    {
        $dto = clone $this->dto;
        $this->initChangelog();

        $dto->setTotal(1);
        $dto->setTaxRate(1);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getTotal()
            ->shouldBe(null);
    }

    /**
     * Value must be null so that is not automatically regenerated
     */
    function it_sets_null_status_on_reset()
    {
        $this->dto->setStatus(InvoiceInterface::STATUS_CREATED);
        $dto = clone $this->dto;

        $this->initChangelog();

        $dto->setTaxRate(1);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getStatus()
            ->shouldBe(null);
    }

    function it_does_not_reset_calculated_values_if_entity_is_new()
    {
        $dto = clone $this->dto;
        $this->dto->setId(null);
        $this->initChangelog();

        $dto->setTaxRate(1.0);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getTaxRate()
            ->shouldBe(1.0);
    }

    function it_does_not_reset_calculated_values_if_status_is_waiting()
    {
        $dto = clone $this->dto;
        $this->dto->setStatus(InvoiceInterface::STATUS_WAITING);
        $this->initChangelog();

        $dto->setTaxRate(1.0);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getTaxRate()
            ->shouldBe(1.0);
    }

    function it_does_not_reset_calculated_values_if_status_is_processing()
    {
        $dto = clone $this->dto;
        $this->dto->setStatus(InvoiceInterface::STATUS_PROCESSING);
        $this->initChangelog();

        $dto->setTaxRate(1.0);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getTaxRate()
            ->shouldBe(1.0);
    }
}
