<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CallCsvSchedulerDto extends CallCsvSchedulerDtoAbstract
{
    /** @var string */
    private $type;

    public function denormalize(array $data, string $context, string $role = '')
    {
        $data = $this->filterReadOnlyFields($data);

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

    private function filterReadOnlyFields(array $data): array
    {
        $readOnlyFlds = [
            'lastExecution',
            'lastExecutionError'
        ];

        foreach ($readOnlyFlds as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        return $data;
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'company' => 'companyId',
                'frequency' => 'frequency',
                'unit' => 'unit',
                'callDirection' => 'callDirection',
                'email' => 'email',
                'lastExecution' => 'lastExecution',
                'lastExecutionError' => 'lastExecutionError',
                'nextExecution' => 'nextExecution'

            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     *
     * @return null|string
     */
    public function getCompanyType(): ?string
    {
        $company = $this->getCompany();
        if (!$company) {
            return null;
        }

        return $company->getType();
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setCompanyType(string $type = null): static
    {
        $this->type = $type;
        switch ($type) {
            case CompanyInterface::TYPE_VPBX;

                $this
                    ->setRetailAccount(null)
                    ->setResidentialDevice(null);
                break;
            case CompanyInterface::TYPE_RETAIL:
                $this
                    ->setUser(null)
                    ->setFax(null)
                    ->setFriend(null)
                    ->setResidentialDevice(null);

                break;
            case CompanyInterface::TYPE_RESIDENTIAL:
                $this
                    ->setUser(null)
                    ->setFax(null)
                    ->setFriend(null)
                    ->setRetailAccount(null);

                break;
            default:
                $this
                    ->setCompany(null)
                    ->setUser(null)
                    ->setFax(null)
                    ->setFriend(null)
                    ->setRetailAccount(null)
                    ->setResidentialDevice(null);
        }

        return $this;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function getVpbxId()
    {
        return $this->getCompanyId();
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setVpbxId($id): static
    {
        if ($this->type === CompanyInterface::TYPE_VPBX) {
            $this->setCompanyId($id);
        }

        return $this;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function getRetailId()
    {
        return $this->getCompanyId();
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setRetailId($id): static
    {
        if ($this->type === CompanyInterface::TYPE_RETAIL) {
            $this->setCompanyId($id);
        }

        return $this;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function getResidentialId()
    {
        return $this->getCompanyId();
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setResidentialId($id): static
    {
        if ($this->type === CompanyInterface::TYPE_RESIDENTIAL) {
            $this->setCompanyId($id);
        }

        return $this;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     *
     * @return null|string
     */
    public function getEndpointType()
    {
        if ($this->getUserId()) {
            return 'user';
        }

        if ($this->getFaxId()) {
            return 'fax';
        }

        if ($this->getFriendId()) {
            return 'friend';
        }

        return null;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setEndpointType(): static
    {
        return $this;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     *
     * @return null|string
     */
    public function getResidentialEndpointType()
    {
        if ($this->getResidentialDeviceId()) {
            return 'residentialDevice';
        }

        if ($this->getFaxId()) {
            return 'fax';
        }

        return null;
    }

    /**
     * @TODO: Remove this as soon as klear is dead
     */
    public function setResidentialEndpointType(): static
    {
        return $this;
    }
}
