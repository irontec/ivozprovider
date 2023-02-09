<?php

namespace Tests\Provider\Voicemail;

use Ivoz\Provider\Domain\Model\User\UserRepository;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailRepository;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\User\User;

class VoicemailRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_gets_available_voicemails();
    }

    public function it_gets_available_voicemails()
    {
        /** @var UserRepository $userRepository */
        $userRepository = $this->em
            ->getRepository(User::class);

        /** @var VoicemailRepository $voicemailRepostory */
        $voicemailRepostory = $this->em
            ->getRepository(Voicemail::class);

        $voicemails = $voicemailRepostory
            ->getAvailableVoicemailsForUser(
                $userRepository->find(1)
            );

        $this->assertIsArray(
            $voicemails
        );

        $this->assertInstanceOf(
            Voicemail::class,
            $voicemails[0]
        );
    }
}
