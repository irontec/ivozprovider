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
         * @todo review this
         */
        $nullableFields = array(
            'user'          => 'user',
            'IvrCommon'     => 'IvrCommon',
            'IvrCustom'     => 'IvrCustom',
            'huntGroup'     => 'huntGroup',
            'fax'           => 'fax',
            'friend'        => 'friendValue',
            'conferenceRoom' => 'conferenceRoom',
            'queue'         => 'queue',
        );

        $routeType = $entity->getRouteType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }

            $setter = 'set' . ucfirst($fieldName);
            $entity->{$setter}(null);
        }

        /**
         * Set standarized E164 number
         * @todo FIXME Country IS MANDATODY
         * @var Country $country
         */
        $country = $entity->getCountry();
        $entity->setDdiE164($country->getCallingCode() . $entity->getDdi());

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