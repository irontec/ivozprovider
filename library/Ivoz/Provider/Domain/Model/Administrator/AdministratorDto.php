<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

class AdministratorDto extends AdministratorDtoAbstract
{
    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        if (!$hideSensitiveData) {
            return $response;
        }
        $response['pass'] = '****';

        return $response;
    }
}


