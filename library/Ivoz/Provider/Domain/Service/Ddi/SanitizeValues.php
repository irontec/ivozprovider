<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Ddi
 * @lifecycle pre_persist
 */
class SanitizeValues implements DdiLifecycleEventHandlerInterface
{
    public function __construct() {}

    /**
     * @throws \Exception
     */
    public function execute(DdiInterface $entity, $isNew)
    {
        /**
         * Set standarized E164 number
         * @todo FIXME Country IS MANDATODY
         * @var Country $country
         */
        $country = $entity->getCountry();
        if (!$country) {
            throw new  \Exception('Country is mandatory');
        }

        $entity->setDdie164(
            $country->getCallingCode()
            . $entity->getDdi()
        );

        // If billInboundCalls is set, peeringContract must have externallyRated to 1
        if (
            $entity->getBillInboundCalls()
            && !$entity->getPeeringContract()->getExternallyRated()
        ) {
            throw new \Exception(
                'Inbound Calls cannot be billed as PeeringContract is not externally rated',
                90000
            );
        }
    }
}