<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

class CallCsvSchedulerDto extends CallCsvSchedulerDtoAbstract
{
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

    /**
     * @param array $data
     */
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
     * Remove this as soon as klear is dead
     */
    public function getCompanyType()
    {
        $company = $this->getCompany();
        if (!$company) {
            return null;
        }

        return $company->getType();
    }

    /**
     * Remove this as soon as klear is dead
     */
    public function setCompanyType(string $type = null)
    {
        if (is_null($type)) {
            $this->setCompany(null);
        }
    }
}
