<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

class TrunksUacregDto extends TrunksUacregDtoAbstract
{
    protected $sensitiveFields = [
        'auth_password',
    ];
}
