<?php

namespace Tests\Provider\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;

class AstVoicemailRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_mailbox_and_context();
    }

    public function its_instantiable()
    {
        /** @var VoicemailRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Voicemail::class);

        $this->assertInstanceOf(
            VoicemailRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_mailbox_and_context()
    {
        /** @var VoicemailRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Voicemail::class);

        $result = $repository->findByMailboxAndContext(
            'user1',
            'company1'
        );

        $this->assertInstanceOf(
            VoicemailInterface::class,
            $result
        );
    }
}
