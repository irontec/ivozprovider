<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Kam\Domain\Model\UsersLocation\RegistrationStatus;

class TerminalDto extends TerminalDtoAbstract
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

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_STATUS) {
            $baseAttributes = [
                'id' => 'id',
                'name' => 'name',
                'domainName' => 'domainName',
                'status' => [[
                    'contact',
                    'expires',
                    'userAgent'
                ]]
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

    public function denormalize(array $data, string $context, string $role = ''): void
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
}
