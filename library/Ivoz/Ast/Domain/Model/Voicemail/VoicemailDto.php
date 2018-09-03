<?php

namespace Ivoz\Ast\Domain\Model\Voicemail;

class VoicemailDto extends VoicemailDtoAbstract
{
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['password'] = '****';
        $response['imappassword'] = '****';

        return $response;
    }
}
