<?php

namespace Tests\Provider\Voicemail;

use Ivoz\Ast\Domain\Model\Voicemail\Voicemail as AstVoicemail;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\Voicemail\VoicemailDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class VoicemailLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return VoicemailDto
     */
    protected function getVoicemailDto()
    {
        $voicemailDto = new VoicemailDto();
        $voicemailDto
            ->setName('Test Voicemail')
            ->setEmail('test@democompany.com')
            ->setEnabled(true)
            ->setSendMail(true)
            ->setAttachSound(false)
            ->setCompanyId(1);

        return $voicemailDto;
    }

    protected function addVoicemail()
    {
        $dto = $this->getVoicemailDto();
        return $this
            ->entityTools
            ->persistDto($dto, null, true);
    }

    protected function updateVoicemail()
    {
        $voicemailRepository = $this->em
            ->getRepository(Voicemail::class);

        $voicemail = $voicemailRepository->find(1);

        /** @var VoicemailDto $voicemailDto */
        $voicemailDto = $this->entityTools->entityToDto(
            $voicemail
        );

        $voicemailDto
            ->setName('UpdatedTest')
            ->setEmail('updated@democompany.com');

        return $this
            ->entityTools
            ->persistDto($voicemailDto, $voicemail, true);
    }

    protected function removeVoicemail()
    {
        $this->updateVoicemail();
        $this->resetChangelog();

        $voicemailRepository = $this->em
            ->getRepository(Voicemail::class);

        $voicemail = $voicemailRepository->find(1);

        $this
            ->entityTools
            ->remove($voicemail);
    }

    /**
     * @test
     */
    public function it_persists_voicemail()
    {
        $voicemailRepository = $this->em
            ->getRepository(Voicemail::class);

        $fixtureVoicemails = $voicemailRepository->findAll();

        $this->addVoicemail();

        $voicemails = $voicemailRepository->findAll();
        $this->assertCount(
            count($fixtureVoicemails) + 1,
            $voicemails
        );

        /////////////////////////////////
        ///
        /////////////////////////////////

        $this->it_triggers_lifecycle_services();
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            Voicemail::class,
            AstVoicemail::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateVoicemail();
        $this->assetChangedEntities([
            Voicemail::class,
            AstVoicemail::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeVoicemail();
        $this->assetChangedEntities([
            Voicemail::class,
            Ivr::class,
        ]);
    }
}
