<?php

namespace Feeder;

use Feeder\RandomStringGenerator as Random;

class UsersCall extends AbstractCall
{
    protected $party;

    public function __construct()
    {
        $this->callId =
            Random::alphaNum(10)
            . "@"
            . '192.168.0.'
            . rand(1, 255);

        $this->party = rand(100, 400);
    }


    public function progress(): array
    {
        switch ($this->status) {
            case null:
            case self::CALL_SETUP:
            case self::RINGING:
                return parent::progress();

            case self::IN_CALL:
                if (rand(0, 10) > 2) {
                    return parent::progress();
                }

                return $this->updateClid();

            default:
                throw new \Exception(
                    'No progress to apply on status '
                    . $this->status
                );
        }
    }

    protected function callSetup(): array
    {
        $this->status = self::CALL_SETUP;

        $payload = [
            "Event" => $this->status,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "Party" => $this->party,
            "Brand" => 1,
            "BrandName" => "brand1",
            "Company" => 1,
            "CompanyName" => "company1",
            "Direction" => "outbound",
            "Owner" => "u1",
            "OwnerName" => "user1"
        ];

        $this->channel = sprintf(
            'users:b%d:c%d:%s:%s',
            $payload['Brand'],
            $payload['Company'],
            $payload['Owner'],
            $payload['Call-ID']
        );

        return [
            $this->channel => $payload
        ];
    }

    protected function updateClid(): array
    {
        $this->status = self::HANG_UP;

        $payload = [
            "Event" => self::UPDATE_CLID,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "Party" => '+3464' . Random::numberic()
        ];

        return [
            $this->channel => $payload
        ];
    }
}
