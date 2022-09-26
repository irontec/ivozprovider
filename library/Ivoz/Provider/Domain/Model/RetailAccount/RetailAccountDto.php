<?php

namespace Ivoz\Provider\Domain\Model\RetailAccount;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;

class RetailAccountDto extends RetailAccountDtoAbstract
{
    public const CONTEXT_STATUS = 'status';

    /**
     * @var RegistrationStatus[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus",
     *     description="Registration status"
     * )
     */
    private $status = [];

    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Registration domain"
     * )
     */
    private $domainName;

    public function addStatus(RegistrationStatus $status): static
    {
        $this->status[] = $status;

        return $this;
    }

    public function setDomainName(string $name): void
    {
        $this->domainName = $name;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['domainName'] = $this->domainName;
        $response['status'] = array_map(
            function (RegistrationStatus $registrationStatus): array {
                return $registrationStatus->toArray();
            },
            $this->status
        );

        return $response;
    }

    /**
     * @codeCoverageIgnore
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $role = null): array
    {
        $showStatus = in_array(
            $context,
            [
                RetailAccountDto::CONTEXT_STATUS,
                RetailAccountDto::CONTEXT_COLLECTION,
            ]
        );

        if ($showStatus) {
            $baseAttributes = [
                'id' => 'id',
                'name' => 'name',
                'domainName' => 'domainName',
                'directConnectivity' => 'directConnectivity',
                'description' => 'description',
                'status' => [[
                    'contact',
                    'publicContact',
                    'received',
                    'publicReceived',
                    'expires',
                    'userAgent'
                ]]
            ];

            if ($role === 'ROLE_BRAND_ADMIN') {
                $baseAttributes['companyId'] = 'company';
                $baseAttributes['rtpEncryption'] = 'rtpEncryption';
                $baseAttributes['multiContact'] = 'multiContact';
            }

            return $baseAttributes;
        }

        $response = parent::getPropertyMap($context);

        $showStatus = in_array(
            $context,
            [
                RetailAccountDto::CONTEXT_SIMPLE,
                RetailAccountDto::CONTEXT_DETAILED,
            ]
        );
        if ($showStatus) {
            $response['status'] = [[
                'contact',
                'publicContact',
                'received',
                'publicReceived',
                'expires',
                'userAgent'
            ]];
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            return self::filterFieldsForBrandAdmin($response);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        } elseif ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
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
            'companyId',
            'transformationRuleSetId',
            'outgoingDdiId',
            'status',
            'rtpEncryption',
            'multiContact',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
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
            'directConnectivity',
            'transport',
            'ip',
            'port',
            'id',
            'transformationRuleSetId',
            'outgoingDdiId',
            'password',
            'status',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
