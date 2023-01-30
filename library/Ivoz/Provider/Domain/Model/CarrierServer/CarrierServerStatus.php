<?php

namespace Ivoz\Provider\Domain\Model\CarrierServer;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class CarrierServerStatus
{
    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $registered = false;

    public function __construct(
        bool $registered
    ) {
        $this->registered = $registered;
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
}
