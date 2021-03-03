<?php

namespace spec\Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class QueueSpec extends ObjectBehavior
{
    use HelperTrait;

    private $dto;

    private $transformer;

    public function let(
        CompanyInterface $company
    ) {
        $companyDto = new CompanyDto();
        $this->dto = new QueueDto();
        $this->dto
            ->setName('Name')
            ->setCompany($companyDto);

        $this->transformer = new \spec\DtoToEntityFakeTransformer([
            [$companyDto, $company->getWrappedObject()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$this->dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Queue::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['Some value']);
    }

    function it_accepts_valid_name()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['SomeValue']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['Some-value']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['Some_value_2']);
    }

    function it_turns_zero_maxWaitTime_to_null()
    {
        $dto = clone $this->dto;
        $dto
            ->setMaxWaitTime(0);
        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getMaxWaitTime()
            ->shouldBe(null);
    }

    function it_turns_zero_maxlen_to_null()
    {
        $this->setMaxlen(0);

        $this
            ->getMaxlen()
            ->shouldBe(null);
    }
}
