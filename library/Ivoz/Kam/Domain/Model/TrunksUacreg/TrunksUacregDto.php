<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;


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


