<?php

namespace DataFixtures\Stub\Ast;

use DataFixtures\Stub\StubTrait;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Ast\Domain\Model\Voicemail\VoicemailDto;

class VoicemailStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Voicemail::class;
    }

    protected function load()
    {
        $dto = (new VoicemailDto(1))
            ->setContext('company1')
            ->setMailbox('user1')
            ->setCallback('users')
            ->setFullname('Alice Allison')
            ->setEmail('alice@democompany.com')
            ->setAttach('yes')
            ->setTz('Europe/Madrid')
            ->setVoicemailId(
                1
            );
        $this->append($dto);

        $dto = (new VoicemailDto(2))
            ->setContext('company1')
            ->setMailbox('user2')
            ->setCallback('users')
            ->setFullname('Bob ')
            ->setEmail('bob@democompany.com')
            ->setAttach('yes')
            ->setTz('Europe/Madrid')
            ->setVoicemailId(
                2
            );
        $this->append($dto);

        $dto = (new VoicemailDto(3))
            ->setContext('company4')
            ->setMailbox('residentialDevice')
            ->setCallback('residential')
            ->setFullname('residentialDevice ')
            ->setEmail('residential@democompany.com')
            ->setAttach('yes')
            ->setTz('Europe/Madrid')
            ->setVoicemailId(
                3
            );
        $this->append($dto);
    }
}
