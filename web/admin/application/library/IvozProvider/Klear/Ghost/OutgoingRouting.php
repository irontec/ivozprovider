<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingDto;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrier;
use Ivoz\Provider\Domain\Model\OutgoingRoutingRelCarrier\OutgoingRoutingRelCarrierDto;

class IvozProvider_Klear_Ghost_OutgoingRouting extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * Get Carrier names separated by comma
     *
     * @param OutgoingRoutingDto $outgoingRouting
     * @return string with Carrier names
     * @throws Exception
     */
    public function getCarriers(OutgoingRoutingDto $outgoingRouting)
    {
        /** @var DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        switch ($outgoingRouting->getRoutingMode()) {
            case OutgoingRouting::MODE_STATIC:
                $carrierIds = array(
                    $outgoingRouting->getCarrierId()
                );
                break;
            case OutgoingRouting::MODE_LCR:
                /** @var OutgoingRoutingRelCarrierDto[] $outgoingRoutingRelCarriers */
                $outgoingRoutingRelCarriers = $dataGateway->findBy(OutgoingRoutingRelCarrier::class, [
                    "OutgoingRoutingRelCarrier.outgoingRouting = " . $outgoingRouting->getId()
                ]);

                $carrierIds = array_map(
                    function (OutgoingRoutingRelCarrierDto $outgoingRoutingRelCarrier) {
                        return $outgoingRoutingRelCarrier->getCarrierId();
                    },
                    $outgoingRoutingRelCarriers
                );
                break;
            default:
                return Klear_Model_Gettext::gettextCheck('_("Invalid route mode")');
        }

        if (empty($carrierIds)) {
            return Klear_Model_Gettext::gettextCheck('_("No carriers")');
        }

        /** @var CarrierDto[] $carrier */
        $carriers = $dataGateway->findBy(
            Carrier::class,
            ["Carrier.id IN (" . implode(',', $carrierIds) . ")"]
        );

        $carrierNames = array_map(
            function (CarrierDto $carrierDtos) {
                return $carrierDtos->getName();
            },
            $carriers
        );


        return implode(',', $carrierNames);
    }
}
