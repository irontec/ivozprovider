<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

class VoicemailDto extends VoicemailDtoAbstract
{
    protected $sensitiveFields = [
        'password',
        'imappassword',
    ];
}
