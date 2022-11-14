<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

class CarrierServerStatus
{
    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $registered = false;

    public function __construct(
        int $statusCode
    ) {
        $this
            ->setRegistered(
                $statusCode === 0
            );
    }

    /**
     * @return array{'registered': boolean}
     */
    public function toArray(): array
    {
        return [
            'registered' => $this->getRegistered()
        ];
    }

    public function getRegistered(): bool
    {
        return $this->registered;
    }

    private function setRegistered(bool $registered): static
    {
        $this->registered = $registered;

        return $this;
    }
}
