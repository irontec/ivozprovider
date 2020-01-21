<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

class SpecialNumberDto extends SpecialNumberDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'number' => 'number',
                'disableCDR' => 'disableCDR',
                'id' => 'id',
                'countryId' => 'country'
            ];
        } else {
            $response = parent::getPropertyMap($context, $role);
        }

        unset($response['brandId']);
        unset($response['numberE164']);

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);

        $editable =
            $this->getBrandId()
            || (!$this->getId());

        if ($role === 'ROLE_BRAND_ADMIN' && $editable) {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
