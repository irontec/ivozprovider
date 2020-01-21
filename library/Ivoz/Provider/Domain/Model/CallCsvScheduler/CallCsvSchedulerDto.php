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
}
