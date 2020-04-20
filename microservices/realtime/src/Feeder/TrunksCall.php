<?php

namespace Feeder;

use Feeder\RandomStringGenerator as Random;

class TrunksCall extends AbstractCall
{
    /** @var string */
    protected $caller;

    /** @var string */
    protected $callee;

    public function __construct()
    {
        $this->callId =
            Random::alphaNum(8)
            . "-"
            . Random::alphaNum(4)
            . "-"
            . Random::alphaNum(4)
            . "-"
            . Random::alphaNum(4)
            . "-"
            . Random::alphaNum(12);

        $this->caller = '+3494' . Random::numberic();
        $this->callee = '+3464' . Random::numberic();
    }

    protected function callSetup(): array
    {
        $this->status = self::CALL_SETUP;

        $payload = [
            "Event" => $this->status,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "Caller" => $this->caller,
            "Callee" => $this->callee,
            "BrandId" => 1,
            "Brand" => "brand1",
            "CompanyId" => 1,
            "Company" => "company1"
        ];

        $outbound = rand(1, 3) > 1;
        if ($outbound) {
            $payload = $payload + [
                "Direction" => "outbound",
                "CarrierId" => 1,
                "Carrier" => "carrier1"
            ];

            $this->channel = sprintf(
                'trunks:b%d:c%d:cr%d:%s',
                $payload['BrandId'],
                $payload['CompanyId'],
                $payload['CarrierId'],
                $payload['Call-ID']
            );
        } else {
            $payload = $payload + [
                "Direction" => "inbound",
                "DdiProviderId" => 1,
                "DdiProvider" => 'DdiProvider1',
            ];

            $this->channel = sprintf(
                'trunks:b%d:c%d:dp%d:%s',
                $payload['BrandId'],
                $payload['CompanyId'],
                $payload['DdiProviderId'],
                $payload['Call-ID']
            );
        }

        unset($payload['BrandId']);
        unset($payload['CompanyId']);
        unset($payload['CarrierId']);
        unset($payload['DdiProviderId']);

        return [
            $this->channel => $payload
        ];
    }
}
