<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

class CallCsvSchedulerDto extends CallCsvSchedulerDtoAbstract
{
    public function denormalize(array $data, string $context, string $role = '')
    {
        $data = $this->filterReadOnlyFields($data);
        return parent::denormalize($data, $context, $role);
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
            return [
                'id' => 'id',
                'name' => 'name',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
