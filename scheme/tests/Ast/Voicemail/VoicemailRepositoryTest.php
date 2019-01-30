<?php

namespace Tests\Provider\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\VoicemailInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailRepository;

class VoicemailRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
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

    /**
     * @test
     */
    public function it_finds_by_userId()
    {
        /** @var VoicemailRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Voicemail::class);

        $result = $repository->findOneByUserId(1);

        $this->assertInstanceOf(
            VoicemailInterface::class,
            $result
        );
    }
}
