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
     * @codeCoverageIgnore
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

        $response = parent::getPropertyMap(...func_get_args());
        if (array_key_exists('domainId', $response)) {
            unset($response['domainId']);
        }

        return $response;
    }
}
