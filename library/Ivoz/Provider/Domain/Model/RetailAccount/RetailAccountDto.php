<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

class RetailAccountDto extends RetailAccountDtoAbstract
{
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['password'] = '****';

        return $response;
    }
}


