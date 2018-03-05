<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

class TerminalDto extends TerminalDtoAbstract
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

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'mac' => 'mac',
                'lastProvisionDate' => 'lastProvisionDate'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


