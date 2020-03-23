<?php

namespace Feeder;

class UsersCallEvent extends AbstractCall
{
    protected function callSetup(): array
    {
        $this->status = self::CALL_SETUP;

        $payload = [
            "Event" => $this->status,
            "time" => time(),
            "callid" => $this->callId,
            "party" => $this->caller,
            "brand" => 1,
            "brandName" => "brand1",
            "company" => 3,
            "companyName" => "company1",
            "direction" => "outbound",
            "owner" => "u1",
            "ownerName" => "user1"
        ];

        $payload = $payload + [
                "direction" => "outbound",
                "carrier" => 1,
            ];

        $this->channel = sprintf(
            'users:b%d:c%d:%s:%s',
            $payload['brand'],
            $payload['company'],
            $payload['owner'],
            $payload['callid']
        );

        return [
            $this->channel => $payload
        ];
    }
}
