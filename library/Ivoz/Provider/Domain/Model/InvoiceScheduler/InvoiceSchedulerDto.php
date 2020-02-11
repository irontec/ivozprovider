<?php

namespace Ivoz\Provider\Domain\Model\InvoiceScheduler;

class InvoiceSchedulerDto extends InvoiceSchedulerDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'unit' => 'unit',
                'frequency' => 'frequency',
                'lastExecution' => 'lastExecution',
                'nextExecution' => 'nextExecution',
                'id' => 'id',
                'brandId' => 'brand',
                'companyId' => 'company',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
