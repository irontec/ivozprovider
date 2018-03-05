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

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'transport' => 'transport',
                'authNeeded' => 'authNeeded'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


