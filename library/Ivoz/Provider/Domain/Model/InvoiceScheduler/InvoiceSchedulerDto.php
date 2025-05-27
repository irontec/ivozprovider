<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

class InvoiceSchedulerDto extends InvoiceSchedulerDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'unit' => 'unit',
                'frequency' => 'frequency',
                'lastExecution' => 'lastExecution',
                'lastExecutionError' => 'lastExecutionError',
                'nextExecution' => 'nextExecution',
                'id' => 'id',
                'brandId' => 'brand',
                'companyId' => 'company',
            ];
        }

        $result = parent::getPropertyMap(...func_get_args());
        unset($result['errorCount']);

        return $result;
    }
}
