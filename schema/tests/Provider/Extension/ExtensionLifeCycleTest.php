<?php

namespace Tests\Provider\Extension;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail as AstVoicemail;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\Extension\ExtensionDto;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ExtensionLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function addExtension()
    {
        $extensionDto = new ExtensionDto();
        $extensionDto
            ->setNumber('104')
            ->setRouteType('user')
            ->setCompanyId(1)
            ->setUserId(1)
            ->setNumberCountryId(1);

        return $this
            ->entityTools
            ->persistDto($extensionDto, null, true);
    }

    protected function updateExtension()
    {
        $extensionRepository = $this->em
            ->getRepository(Extension::class);

        $extension = $extensionRepository->find(1);

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $this->entityTools->entityToDto($extension);

        $extensionDto
            ->setNumber('108')
            ->setUserId(2);

        return $this
            ->entityTools
            ->persistDto($extensionDto, $extension, true);
    }

    protected function removeExtension()
    {
        $extensionRepository = $this->em
            ->getRepository(Extension::class);

        $extension = $extensionRepository->find(1);

        $this
            ->entityTools
            ->remove($extension);
    }

    /**
     * @test
     */
    public function it_persists_extensions()
    {
        $extensionRepository = $this->em
            ->getRepository(Extension::class);
        $fixtureExtensions = $extensionRepository->findAll();

        $extension = $this->addExtension();

        $extensions = $extensionRepository->findAll();
        $this->assertCount(
            count($fixtureExtensions) + 1,
            $extensions
        );

        /////////////////////////////////
        ///
        /////////////////////////////////
        $this->it_triggers_lifecycle_services();
        $this->new_extension_userId_updates_users($extension);
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Extension::class,
            PsEndpoint::class,
            User::class,
            Voicemail::class,
            AstVoicemail::class
        ]);
    }

    protected function new_extension_userId_updates_users(Extension $extension)
    {
        $this->resetChangelog();

        $userRepository = $this
            ->entityTools
            ->getRepository(User::class);

        /** @var User $user */
        $user = $userRepository->findOneBy([
            'extension' => $extension->getId()
        ]);
        $this->assertNotNull($user);

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $this
            ->entityTools
            ->entityToDto($extension);

        $extensionDto->setUserId(2);

        /** @var Extension $extension */
        $this
            ->entityTools
            ->persistDto($extensionDto, $extension, true);

        $changelogEntries = $this->getChangelogByClass(
            User::class
        );

        $this->assertCount(
            2,
            $changelogEntries
        );

        $this->assertEquals(
            $changelogEntries[0]->getData(),
            [
                'extensionId' => null
            ]
        );

        $this->assertEquals(
            $changelogEntries[1]->getData(),
            [
                'extensionId' => 5
            ]
        );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $extension = $this->updateExtension();
        $this->assetChangedEntities([
            Extension::class,
            PsEndpoint::class,
            User::class,
            Voicemail::class,
            AstVoicemail::class,
        ]);
    }

    /**
     * @test
     */
    public function updating_user_screen_extension_updates_prev_user_psEndpoint()
    {
        $extension = $this->addExtension();
        $this->resetChangelog();

        $userRepository = $this->em
            ->getRepository(User::class);

        /** @var User $user */
        $user = $userRepository->findOneBy([
            'extension' => null
        ]);
        $this->assertNotNull($user);

        /** @var ExtensionDto $extensionDto */
        $extensionDto = $this
            ->entityTools
            ->entityToDto($extension);

        $extensionDto->setUserId(2);

        /** @var Extension $extension */
        $this
            ->entityTools
            ->persistDto($extensionDto, $extension, true);

        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(
            2,
            $changelogEntries
        );

        $this->assertEquals(
            $changelogEntries[0]->getData(),
            [
                'callerid' => 'Bob Bobson <104>',
                'mailboxes' => 'user2@company1'
            ]
        );
    }

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function new_user_screen_extension_updates_psEndpoint()
    {
        $userRepository =  $this->em
            ->getRepository(User::class);

        /** @var User $user */
        $user = $userRepository->findOneBy([
            'extension' => null
        ]);
        $this->assertNotNull($user);

        $extensionDto = new ExtensionDto();
        $extensionDto
            ->setNumber("104")
            ->setRouteType("user")
            ->setCompanyId(
                $user->getCompany()->getId()
            )
            ->setUserId(
                $user->getId()
            )
            ->setNumberCountryId(1);

        /** @var Extension $extension */
        $this
            ->entityTools
            ->persistDto($extensionDto, null, true);

        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(
            1,
            $changelogEntries
        );

        foreach ($changelogEntries as $changelogEntry) {
            $this->assertEquals(
                $changelogEntry->getData(),
                [
                    'callerid' => 'Alice Allison <104>',
                    'mailboxes' => 'user1@company1',
                    'named_pickup_group' => '1'
                ]
            );
        }
    }
}
