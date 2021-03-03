<?php

namespace spec\Ivoz\Provider\Domain\Model\ConferenceRoom;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoom;
use Ivoz\Provider\Domain\Model\ConferenceRoom\ConferenceRoomDto;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class ConferenceRoomSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let()
    {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(Company::class);

        $dto = new ConferenceRoomDto();
        $dto
            ->setName('Name')
            ->setPinProtected(1)
            ->setMaxMembers(1)
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ConferenceRoom::class);
    }

    function it_resets_pincode_when_not_pin_protected()
    {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(Company::class);

        /** @var ConferenceRoomDto $dto */
        $dto = $this->toDto()->getWrappedObject();
        $dto
            ->setPinCode((string) 1234)
            ->setPinProtected(0)
            ->setCompany($companyDto);

        $this->transformer->appendFixedTransforms([
            [$companyDto, $company]
        ]);

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getPinCode()
            ->shouldBe(null);
    }

    function it_doesnt_change_pincode_if_pin_protected()
    {
        $companyDto = new CompanyDto();
        $company = $this->getInstance(Company::class);
        $pinCode = '1234';

        /** @var ConferenceRoomDto $dto */
        $dto = $this->toDto()->getWrappedObject();
        $dto
            ->setPinCode($pinCode)
            ->setPinProtected(1)
            ->setCompany($companyDto);

        $this
            ->transformer
            ->appendFixedTransforms([
                [$companyDto, $company]
            ]);

        $this->updateFromDto(
            $dto,
            $this->transformer
        );

        $this
            ->getPinCode()
            ->shouldBe($pinCode);
    }
}
