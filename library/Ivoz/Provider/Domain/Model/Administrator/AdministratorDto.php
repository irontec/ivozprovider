<?php

namespace Ivoz\Provider\Domain\Model\Administrator;

class AdministratorDto extends AdministratorDtoAbstract
{
    /**
     * @inheritdoc
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

    /**
     * @inheritdoc
     */
    public function normalize(string $context)
    {
        $response = parent::normalize(...func_get_args());
        if (isset($response['pass'])) {
            $response['pass'] = '*****';
        }

        return $response;
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


