<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

class AdministratorDto extends AdministratorDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'active' => 'active',
                'name' => 'name',
                'lastname' => 'lastname',
                'email' => 'email'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

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
