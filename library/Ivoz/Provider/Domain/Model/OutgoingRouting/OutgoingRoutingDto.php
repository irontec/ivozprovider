<?php

namespace Ivoz\Provider\Domain\Model\OutgoingRouting;

use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;
use Ivoz\Api\Core\Annotation\AttributeDefinition;

class OutgoingRoutingDto extends OutgoingRoutingDtoAbstract
{
    const CONTEXT_WITH_CARRIERS = 'withCarriers';

    const CONTEXTS_WITH_CARRIERS = [
        self::CONTEXT_WITH_CARRIERS,
        self::CONTEXT_DETAILED
    ];

    /**
     * @var int[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="int",
     *     description="Carriers on LCR route type"
     * )
     */
    protected $carrierIds = [];

    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'type' => 'type',
                'priority' => 'priority',
                'weight' => 'weight',
                'routingMode' => 'routingMode',
                'companyId' => 'company',
                'routingTagId' => 'routingTag',
            ];
        }

        $response = parent::getPropertyMap($context);

        if (in_array($context, self::CONTEXTS_WITH_CARRIERS, true)) {
            $response['carrierIds'] = 'carrierIds';
        }

        return $response;
    }


    public function normalize(string $context, string $role = '')
    {
        $response = parent::normalize(
            $context,
            $role
        );

        if (in_array($context, self::CONTEXTS_WITH_CARRIERS, true)) {
            $response['carrierIds'] = $this->carrierIds;
        }

        return $response;
    }

    /**
     * @param int[] $carrierIds
     */
    public function setCarrierIds(array $carrierIds)
    {
        $this->carrierIds = $carrierIds;

        $relCarriers = [];
        foreach ($carrierIds as $id) {
            $dto = new OutgoingRoutingRelCarrierDto();
            $dto->setCarrierId($id);
            $relCarriers[] = $dto;
        }

        $this->setRelCarriers($relCarriers);
    }
}
