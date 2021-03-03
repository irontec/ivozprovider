<?php

namespace spec\Ivoz\Provider\Domain\Model\User;

use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneDto;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class UserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var UserDto
     */
    protected $dto;

    protected $company;
    protected $timezone;
    protected $transformer;

    function let()
    {
        $this->company = $this->getTestDouble(
            CompanyInterface::class,
            true
        );

        $this->timezone = $this->getTestDouble(
            TimezoneInterface::class,
            true
        );

        $companyDto = new CompanyDto();
        $timeZoneDto = new TimezoneDto();

        $this->dto = $dto = new UserDto();
        $dto
            ->setName('Name')
            ->setLastname('lastname')
            ->setActive(true)
            ->setEmail('test@irontec.com')
            ->setPass('changeme')
            ->setCompany($companyDto)
            ->setTimezone($timeZoneDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $this->company->reveal()],
            [$timeZoneDto, $this->timezone->reveal()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(User::class);
    }

    function it_throws_exception_on_userweb_access_without_password()
    {
        $dto = clone $this->dto;
        $dto
            ->setActive(true)
            ->setEmail('test@irontec.com')
            ->setPass(null);

        $this
            ->shouldThrow('DomainException')
            ->during(
                'fromDto',
                [$dto, $this->transformer]
            );
    }
}
