<?php

namespace spec\Ivoz\Provider\Domain\Model\Queue;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Queue\Queue;
use Ivoz\Provider\Domain\Model\Queue\QueueDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class QueueSpec extends ObjectBehavior
{
    use HelperTrait;

    public function let(
        CompanyInterface $company
    ) {
        $dto = new QueueDto();
        $dto->setName('Name');

        $this->hydrate(
            $dto,
            [
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

    function it_turns_empty_maxWaitTime_to_null()
    {
        $this->setMaxWaitTime('');

        $this
            ->getMaxWaitTime()
            ->shouldBe(null);

        $this->setMaxWaitTime(0);

        $this
            ->getMaxWaitTime()
            ->shouldBe(null);
    }

    function it_turns_empty_maxlen_to_null()
    {
        $this->setMaxlen('');

        $this
            ->getMaxlen()
            ->shouldBe(null);

        $this->setMaxlen(0);

        $this
            ->getMaxlen()
            ->shouldBe(null);
    }
}
