<?php

namespace spec\Ivoz\Provider\Domain\Service\User;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Service\User\UserFactory;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class UserFactorySpec extends ObjectBehavior
{
    use HelperTrait;

    protected $userRepository;
    protected $entityTools;

    public function let(
        UserRepository $userRepository,
        EntityTools $entityTools
    ) {
        $this->userRepository = $userRepository;
        $this->entityTools = $entityTools;

        $this->beConstructedWith(
            $this->userRepository,
            $this->entityTools
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UserFactory::class);
    }

    function it_search_for_existing_user()
    {
        $user = $this->getInstance(
            User::class,
            [
                'id' => 5,
                'active' => false,
                'company' => $this->getInstance(Company::class, ['id' => 1]),
            ]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->userRepository
            ->findOneByEmail(
                Argument::any()
            )
            ->willReturn($user);

        $this
            ->entityTools
            ->entityToDto(
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn(
                new UserDto()
            );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class),
                Argument::type(User::class)
            )
            ->willReturn(
                $user
            );

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                'email@domain.net'
            )
            ->shouldReturn($user);
    }

    function it_creates_user_if_not_exists()
    {
        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::any(),
                Argument::any(),
                Argument::any(),
                Argument::any()
            )
            ->shouldBeCalled()
            ->willReturn(null);

        $this
            ->userRepository
            ->findOneByEmail(
                Argument::any()
            )
            ->willReturn();

        $user = $this->getInstance(
            User::class,
            ['active' => false]
        );

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class),
                null
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                'email@domain.net'
            )
            ->shouldReturn($user);
    }

    function it_rejects_emails_of_users_from_other_clients()
    {
        $otherClientUser = $this->getInstance(
            User::class,
            [
                'active' => false,
                'company' => $this->getInstance(Company::class, ['id' => 2]),
            ]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                Argument::cetera()
            )
            ->willReturn(null);

        $this
            ->userRepository
            ->findOneByEmail(
                'email@domain.net'
            )
            ->willReturn($otherClientUser);

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::cetera()
            )
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->during(
                'fromMassProvisioningCsv',
                [1, 'name', 'lastname', 'email@domain.net']
            );
    }

    function it_updates_the_user_found_by_email_within_the_client()
    {
        $company = $this->getInstance(Company::class, ['id' => 1]);

        $emailOwner = $this->getInstance(
            User::class,
            ['id' => 6, 'active' => false, 'company' => $company]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                1,
                'name',
                'lastname'
            )
            ->willReturn(null);

        $this
            ->userRepository
            ->findOneByEmail(
                'email@domain.net'
            )
            ->willReturn($emailOwner);

        $this
            ->entityTools
            ->entityToDto($emailOwner)
            ->shouldBeCalled()
            ->willReturn(new UserDto());

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::type(UserDto::class),
                $emailOwner
            )
            ->shouldBeCalled()
            ->willReturn($emailOwner);

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                'email@domain.net'
            )
            ->shouldReturn($emailOwner);
    }

    function it_rejects_emails_already_used_by_another_user()
    {
        $company = $this->getInstance(Company::class, ['id' => 1]);

        $user = $this->getInstance(
            User::class,
            ['id' => 5, 'active' => false, 'company' => $company]
        );

        $emailOwner = $this->getInstance(
            User::class,
            ['id' => 6, 'active' => false, 'company' => $company]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                1,
                'name',
                'lastname'
            )
            ->willReturn($user);

        $this
            ->userRepository
            ->findOneByEmail(
                'email@domain.net'
            )
            ->willReturn($emailOwner);

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::cetera()
            )
            ->shouldNotBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->during(
                'fromMassProvisioningCsv',
                [1, 'name', 'lastname', 'email@domain.net']
            );
    }

    function it_keeps_the_email_of_existing_users_when_none_is_given()
    {
        $user = $this->getInstance(
            User::class,
            [
                'active' => false,
                'company' => $this->getInstance(Company::class, ['id' => 1]),
            ]
        );

        $this
            ->userRepository
            ->findOneByCompanyAndName(
                1,
                'name',
                'lastname'
            )
            ->willReturn($user);

        $this
            ->userRepository
            ->findOneByEmail(
                Argument::any()
            )
            ->shouldNotBeCalled();

        $userDto = (new UserDto())
            ->setEmail('kept@domain.net');

        $this
            ->entityTools
            ->entityToDto($user)
            ->willReturn($userDto);

        $this
            ->entityTools
            ->dtoToEntity(
                Argument::that(function ($dto) {
                    return $dto instanceof UserDto
                        && $dto->getEmail() === 'kept@domain.net';
                }),
                $user
            )
            ->shouldBeCalled()
            ->willReturn($user);

        $this
            ->fromMassProvisioningCsv(
                1,
                'name',
                'lastname',
                ''
            )
            ->shouldReturn($user);
    }
}
