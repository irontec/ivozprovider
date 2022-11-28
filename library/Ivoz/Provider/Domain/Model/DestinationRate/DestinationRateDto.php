<?php

namespace Ivoz\Provider\Domain\Model\DestinationRate;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class DestinationRateDto extends DestinationRateDtoAbstract
{
    /**
     * @var string
     * @AttributeDefinition(
     *     type="string",
     *     description="Cost currency",
     *     writable=false
     * )
     */
    private $currencySymbol = '';

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        $contextsWithCurrencySymbol = [
            self::CONTEXT_COLLECTION,
            self::CONTEXT_DETAILED,
        ];

        if (in_array($context, $contextsWithCurrencySymbol)) {
            return [
                'cost' => 'cost',
                'connectFee' => 'connectFee',
                'rateIncrement' => 'rateIncrement',
                'groupIntervalStart' => 'groupIntervalStart',
                'id' => 'id',
                'destinationRateGroupId' => 'destinationRateGroup',
                'destinationId' => 'destination',
                'currencySymbol' => 'currencySymbol',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['currencySymbol'] = $this->currencySymbol;

        return $response;
    }

    public function setCurrencySymbol(string $currencySymbol): self
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }
}
