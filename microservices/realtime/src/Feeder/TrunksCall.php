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
            "Brand" => 1,
            "BrandName" => "brand1",
            "Company" => 1,
            "CompanyName" => "company1"
        ];

        $outbound = rand(1, 3) > 1;
        if ($outbound) {
            $payload = $payload + [
                "Direction" => "outbound",
                "Carrier" => 1,
                "CarrierName" => "carrier1"
            ];

            $this->channel = sprintf(
                'trunks:b%d:c%d:cr%d:%s',
                $payload['Brand'],
                $payload['Company'],
                $payload['Carrier'],
                $payload['Call-ID']
            );
        } else {
            $payload = $payload + [
                "Direction" => "inbound",
                "DdiProvider" => 1,
                "DdiProviderName" => 'DdiProvider1',
            ];

            $this->channel = sprintf(
                'trunks:b%d:c%d:dp%d:%s',
                $payload['Brand'],
                $payload['Company'],
                $payload['DdiProvider'],
                $payload['Call-ID']
            );
        }

        return [
            $this->channel => $payload
        ];
    }
}
