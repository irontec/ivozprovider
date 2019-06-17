<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Kam\Domain\Model\UsersLocation\Status;

class RetailAccountDto extends RetailAccountDtoAbstract
{
    const CONTEXT_STATUS = 'status';

    /**
     * @var Status[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Ivoz\Kam\Domain\Model\UsersLocation\Status",
     *     description="Registration status"
     * )
     */
    protected $status = [];

    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Registration domain"
     * )
     */
    protected $domainName;

    public function addStatus(Status $status)
    {
        $this->status[] = $status;

        return $this;
    }

    public function setDomainName(string $name)
    {
        $this->domainName = $name;
    }

    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(...func_get_args());

        if (!isset($response['status'])) {
            return $response;
        }

        /**
         * @var int $key
         * @var Status $status
         */
        foreach ($response['status'] as $key => $status) {
            $response['status'][$key] = $status->toArray();
        }

        return $response;
    }

    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        $response['domainName'] = $this->domainName;
        $response['status'] = $this->status;

        return $response;
    }

    /**
     * @codeCoverageIgnore
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $role = null)
    {
        if ($context === self::CONTEXT_STATUS) {
            return [
                'id' => 'id',
                'name' => 'name',
                'domainName' => 'domainName',
                'status' => [
                    'contact',
                    'expires',
                    'userAgent'
                ]
            ];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'transport' => 'transport'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            return self::filterFieldsForBrandAdmin($response);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

    /**
     * @param array $response
     * @return array
     */
    private static function filterFieldsForBrandAdmin(array $response): array
    {
        $allowedFields = [
            'name',
            'description',
            'transport',
            'ip',
            'port',
            'password',
            'fromDomain',
            'directConnectivity',
            'ddiIn',
            't38Passthrough',
            'id',
            'brandId',
            'companyId',
            'transformationRuleSetId',
            'outgoingDdiId'
        ];

        $response = array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }

    /**
     * @param array $response
     * @return array
     */
    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'name',
            'description',
            'transport',
            'id',
            'transformationRuleSetId',
            'outgoingDdiId',
            'companyId',
        ];

        $response = array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }
}
