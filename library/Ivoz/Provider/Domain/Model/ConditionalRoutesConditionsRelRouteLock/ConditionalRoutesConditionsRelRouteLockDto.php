<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelRouteLock;

class ConditionalRoutesConditionsRelRouteLockDto extends ConditionalRoutesConditionsRelRouteLockDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     * @return array<array-key, string>
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'conditionId' => 'condition',
                'routeLockId' => 'routeLock'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
