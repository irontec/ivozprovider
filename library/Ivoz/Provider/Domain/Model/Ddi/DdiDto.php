<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

class DdiDto extends DdiDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'ddi' => 'ddi',
                'ddie164' => 'ddie164',
                'routeType' => 'routeType'
            ];
        }

        return [
            'ddi' => 'ddi',
            'ddie164' => 'ddie164',
            'recordCalls' => 'recordCalls',
            'displayName' => 'displayName',
            'routeType' => 'routeType',
            'billInboundCalls' => 'billInboundCalls',
            'friendValue' => 'friendValue',
            'id' => 'id',
            'companyId' => 'company',
            'brandId' => 'brand',
            'conferenceRoomId' => 'conferenceRoom',
            'languageId' => 'language',
            'queueId' => 'queue',
            'externalCallFilterId' => 'externalCallFilter',
            'userId' => 'user',
            'ivrId' => 'ivr',
            'huntGroupId' => 'huntGroup',
            'faxId' => 'fax',
            'peeringContractId' => 'peeringContract',
            'countryId' => 'country',
            'retailAccountId' => 'retailAccount',
            'conditionalRouteId' => 'conditionalRoute'
        ];
    }
}


