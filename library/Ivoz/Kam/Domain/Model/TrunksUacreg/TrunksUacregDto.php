<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

class TrunksUacregDto extends TrunksUacregDtoAbstract
{
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['auth_password'] = '****';

        return $response;
    }
}
