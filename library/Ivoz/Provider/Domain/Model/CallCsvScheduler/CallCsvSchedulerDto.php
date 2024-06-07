<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;

class CallCsvSchedulerDto extends CallCsvSchedulerDtoAbstract
{
    /** @var ?string */
    private $type;

    public function denormalize(array $data, string $context, string $role = ''): void
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
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'companyId' => 'company',
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
}
