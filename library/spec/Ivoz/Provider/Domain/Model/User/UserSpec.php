<?php

namespace spec\Ivoz\Provider\Domain\Model\User;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Infrastructure\Api\Timezone\UserTimezoneInjector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UserSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var UserDto
     */
    protected $dto;

    protected $company;

    function let()
    {
        $this->company = $this->getTestDouble(
            CompanyInterface::class,
            true
        );

        $timezone = $this->getTestDouble(
            TimezoneInterface::class,
            true
        );

        $this->dto = $dto = new UserDto();
        $dto
            ->setName('Name')
            ->setLastname('lastname')
            ->setActive(true)
            ->setEmail('test@irontec.com')
            ->setPass('changeme');

        $this->hydrate(
            $dto,
            [
                'company' => $this->company->reveal(),
                'timezone' => $timezone->reveal()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
                [$dto, new \spec\DtoToEntityFakeTransformer()]
            );
    }
}
