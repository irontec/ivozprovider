<?php

namespace Ivoz\Provider\Domain\Model\SpecialNumber;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/** @psalm-suppress UnusedProperty */
class SpecialNumberDto extends SpecialNumberDtoAbstract
{
    /**
     * @var string
     * @AttributeDefinition(
     *     type="bool",
     *     writable=false,
     *     description="Global Special Number"
     * )
     */
    private $global;

    public static function getPropertyMap(string $context = '', string $role = null): array
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

        if ($role === 'ROLE_BRAND_ADMIN') {
            $response['global'] = 'global';
        }

        unset($response['brandId']);
        unset($response['numberE164']);

        return $response;
    }

    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(...func_get_args());

        $isBrandAdmin = $role === 'ROLE_BRAND_ADMIN';

        if ($isBrandAdmin) {
            $response['global'] = $this->getBrandId()
                ? false
                : true;
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
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
