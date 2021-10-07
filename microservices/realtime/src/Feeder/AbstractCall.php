<?php

namespace Feeder;

abstract class AbstractCall
{
    const CALL_SETUP = 'Trying';
    const RINGING = 'Early';
    const IN_CALL = 'Confirmed';
    const HANG_UP = 'Terminated';
    const UPDATE_CLID = 'UpdateCLID';

    const SIGNIFICANT_CALL_EVENTS = [
        self::CALL_SETUP,
        self::RINGING,
        self::IN_CALL,
        self::HANG_UP,
        self::UPDATE_CLID,
    ];

    /** @var string */
    protected $id;

    /** @var string */
    protected $callId;

    /** @var string */
    protected $status;

    /** @var string */
    protected $channel;

    public function isDone(): bool
    {
        return $this->status === self::HANG_UP;
    }

    public function getCallId(): string
    {
        return $this->callId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }


    public function getChannel(): string
    {
        return $this->channel;
    }

    public function progress(): array
    {
        switch ($this->status) {
            case null:
                return $this->callSetup();

            case self::CALL_SETUP:
                return $this->ringing();

            case self::RINGING:
                return $this->inCall();

            case self::IN_CALL:
                return $this->hangUp();

            default:
                throw new \Exception(
                    'No progress to apply on status '
                    . $this->status
                );
        }
    }

    abstract protected function callSetup(): array;

    protected function ringing(): array
    {
        $this->status = self::RINGING;

        $payload = [
            "Event" => $this->status,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "ID" => $this->id
        ];

        return [
            $this->channel => $payload
        ];
    }

    protected function inCall(): array
    {
        $this->status = self::IN_CALL;

        $payload = [
            "Event" => $this->status,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "ID" => $this->id
        ];

        return [
            $this->channel => $payload
        ];
    }

    protected function hangUp(): array
    {
        $this->status = self::HANG_UP;

        $payload = [
            "Event" => $this->status,
            "Time" => time(),
            "Call-ID" => $this->callId,
            "ID" => $this->id
        ];

        return [
            $this->channel => $payload
        ];
    }
}
