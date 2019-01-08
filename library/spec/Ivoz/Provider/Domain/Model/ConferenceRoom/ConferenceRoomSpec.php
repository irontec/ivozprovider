<?php

namespace spec\Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ConferenceRoomSpec extends ObjectBehavior
{
    use HelperTrait;

    function let(
        CompanyInterface $company
    ) {
        $dto = new  ConferenceRoomDto();
        $dto->setName('Name')
            ->setPinProtected(1)
            ->setMaxMembers(1);

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
        $this->shouldHaveType(ConferenceRoom::class);
    }

    function it_resets_pincode_when_not_pin_protected(
        CompanyInterface $company
    ) {
        /** @var ConferenceRoomDto $dto */
        $dto = $this->toDto()->getWrappedObject();
        $dto
            ->setPinCode((string) 1234)
            ->setPinProtected(0);

        $this->hydrate(
            $dto,
            ['company' => $company->getWrappedObject()]
        );

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );
        $this
            ->getPinCode()
            ->shouldBe(null);
    }

    function it_doesnt_change_pincode_if_pin_protected(
        CompanyInterface $company
    ) {
        $pinCode = '1234';

        /** @var ConferenceRoomDto $dto */
        $dto = $this->toDto()->getWrappedObject();
        $dto
            ->setPinCode($pinCode)
            ->setPinProtected(1);

        $this->hydrate(
            $dto,
            ['company' => $company->getWrappedObject()]
        );

        $this->updateFromDto(
            $dto,
            new \spec\DtoToEntityFakeTransformer()
        );

        $this
            ->getPinCode()
            ->shouldBe($pinCode);
    }
}
