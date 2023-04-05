<?php

namespace Ivoz\Provider\Domain\Model\Carrier;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class CarrierStatus
{
    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $registered;

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
