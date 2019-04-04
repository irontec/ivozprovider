<?php

namespace spec\Ivoz\Provider\Domain\Model\Invoice;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceDto;
use Ivoz\Provider\Domain\Model\Invoice\InvoiceInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class InvoiceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var InvoiceDto
     */
    protected $dto;

    function let(
        BrandInterface $brand,
        CompanyInterface $company
    ) {
        $this->dto = $dto = new InvoiceDto();
        $dto
            ->setId(1)
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


    function it_resets_calculated_values_if_base_values_have_changed()
    {
        $dto = clone $this->dto;
        $this->initChangelog();

        $dto->setTotal(1);
        $dto->setTaxRate(1);
        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
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
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getTaxRate()
            ->shouldBe(1.0);
    }
}
