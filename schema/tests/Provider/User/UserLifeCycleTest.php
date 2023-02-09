<?php

namespace Tests\Provider\User;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail as AstVoicemail;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class UserLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return UserDto
     */
    protected function getUserDto()
    {
        $userDto = new UserDto();
        $userDto
            ->setName('Test')
            ->setLastname('Smith')
            ->setEmail('test@democompany.com')
            ->setPass('changeme')
            ->setDoNotDisturb(false)
            ->setIsBoss(false)
            ->setActive(true)
            ->setMaxCalls(1)
            ->setGsQRCode(false)
            ->setCompanyId(1)
            ->setTransformationRuleSetId(1)
            ->setTerminalId(3)
            ->setExtensionId(1)
            ->setTimezoneId(1);

        return $userDto;
    }

    protected function addUser()
    {
        $dto = $this->getUserDto();
        return $this
            ->entityTools
            ->persistDto($dto, null, true);
    }

    protected function updateUser()
    {
        $userRepository = $this->em
            ->getRepository(User::class);

        $user = $userRepository->find(1);

        /** @var UserDto $userDto */
        $userDto = $this->entityTools->entityToDto(
            $user
        );

        $userDto
            ->setName('UpdatedTest')
            ->setExtensionId(3);

        return $this
            ->entityTools
            ->persistDto($userDto, $user, true);
    }

    protected function removeUser()
    {
        //Ensure extension association
        $this->updateUser();
        $this->resetChangelog();

        $userRepository = $this->em
            ->getRepository(User::class);

        $user = $userRepository->find(1);

        $this
            ->entityTools
            ->remove($user);
    }

    /**
     * @test
     */
    public function it_persists_user()
    {
        $userRepository = $this->em
            ->getRepository(User::class);

        $fixtureUser = $userRepository->findAll();

        $this->addUser();

        $users = $userRepository->findAll();
        $this->assertCount(
            count($fixtureUser) + 1,
            $users
        );

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            User::class,
            Voicemail::class,
            PsEndpoint::class,
            Extension::class,
            AstVoicemail::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateUser();
        $this->assetChangedEntities([
            User::class,
            Voicemail::class,
            PsEndpoint::class,
            Extension::class,
            AstVoicemail::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeUser();
        $this->assetChangedEntities([
            PsEndpoint::class,
            PickUpRelUser::class, // Orphan removal
            User::class,
            Extension::class,
        ]);
    }
}
