<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

class TerminalDto extends TerminalDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'mac' => 'mac',
                'lastProvisionDate' => 'lastProvisionDate'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('domainId', $response)) {
            unset($response['domainId']);
        }

        return $response;
    }
}
