<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;

class TerminalDto extends TerminalDtoAbstract
{
    const CONTEXT_STATUS = 'status';

    /**
     * @var RegistrationStatus[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus",
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

    public function addStatus(RegistrationStatus $status)
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
         * @var RegistrationStatus $status
         */
        foreach ($response['status'] as $key => $status) {
            $response['status'][$key] = $status->toArray();
        }

        return $response;
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_STATUS) {
            $baseAttributes = [
                'id' => 'id',
                'name' => 'name',
                'domainName' => 'domainName',
                'status' => [
                    'contact',
                    'expires',
                    'userAgent'
                ]
            ];

            if ($role === 'ROLE_BRAND_ADMIN') {
                $baseAttributes['companyId'] = 'company';
            }

            return $baseAttributes;
        }

        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'mac' => 'mac',
                'lastProvisionDate' => 'lastProvisionDate',
                'domainId' => 'domain',
                'terminalModelId' => 'terminalModel'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if (array_key_exists('domainId', $response)) {
            unset($response['domainId']);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    public function toArray($hideSensitiveData = false)
    {
        $response = parent::toArray($hideSensitiveData);
        $response['domainName'] = $this->domainName;
        $response['status'] = $this->status;

        return $response;
    }
}
