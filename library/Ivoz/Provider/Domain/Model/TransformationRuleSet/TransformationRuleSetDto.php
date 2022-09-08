<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class TransformationRuleSetDto extends TransformationRuleSetDtoAbstract
{
    /**
     * @var bool
     * @AttributeDefinition(
     *     type="bool",
     * )
     * @psalm-suppress UnusedProperty
     */
    private $editable = false;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'description' => 'description',
                'internationalCode' => 'internationalCode',
                'trunkPrefix' => 'trunkPrefix',
                'areaCode' => 'areaCode',
                'nationalLen' => 'nationalLen',
                'id' => 'id',
                'name' => ['en','es','ca','it'],
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
            $response['editable'] = 'editable';
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        unset($contextProperties['editable']);

        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['editable'] = (bool) $response['brand'];

        return $response;
    }
}
