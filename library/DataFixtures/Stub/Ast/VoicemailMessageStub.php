<?php

namespace DataFixtures\Stub\Ast;

use DataFixtures\Stub\StubTrait;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessage;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageDto;

class VoicemailMessageStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return VoicemailMessage::class;
    }

    protected function load()
    {
        $dto = (new VoicemailMessageDto(1))
            ->setDir("/opt/irontec/ivozprovider/storage/asterisk/spool/voicemail/company1/user1/INBOX")
            ->setMsgnum(0)
            ->setContext('call-user-cfw')
            ->setCallerid("Alice <101>")
            ->setOrigtime(1648728523)
            ->setDuration(4)
            ->setMailboxuser('user1')
            ->setMailboxcontext('company1')
            ->setMsgId('1648728523-00000000');
        $this->append($dto);

        $dto = (new VoicemailMessageDto(2))
            ->setDir("/opt/irontec/ivozprovider/storage/asterisk/spool/voicemail/company1/user2/INBOX")
            ->setMsgnum(0)
            ->setContext('call-user-cfw')
            ->setCallerid("Alice <101>")
            ->setOrigtime(1648736847)
            ->setDuration(9)
            ->setMailboxuser('user2')
            ->setMailboxcontext('company1')
            ->setMsgId('1648736847-00000000');
        $this->append($dto);

        $dto = (new VoicemailMessageDto(3))
            ->setDir("/opt/irontec/ivozprovider/storage/asterisk/spool/voicemail/company1/user2/INBOX")
            ->setMsgnum(1)
            ->setContext('call-user-cfw')
            ->setCallerid("Alice <101>")
            ->setOrigtime(1648737682)
            ->setDuration(11)
            ->setMailboxuser('user2')
            ->setMailboxcontext('company1')
            ->setMsgId('1648737682-00000001');
        $this->append($dto);
    }
}
