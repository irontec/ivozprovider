<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

/** @psalm-suppress UnusedProperty */
class MatchListDto extends MatchListDtoAbstract
{
    /**
     * @var string
     * @AttributeDefinition(
     *     type="bool",
     *     writable=false,
     *     description="Generic Match List"
     * )
     */
    private $generic;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response =  [
                'id' => 'id',
                'name' => 'name',
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
            $response['generic'] = 'generic';
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['companyId']);
            unset($response['brandId']);
        }

        return $response;
    }

    /**
     * @return array<array-key, mixed>
     */
    public function normalize(string $context, string $role = ''): array
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if ($role === 'ROLE_COMPANY_ADMIN') {
            $response['generic'] = $this->getCompanyId() == null;
        }

        return $response;
    }


    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
