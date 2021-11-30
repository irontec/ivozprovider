<?php

namespace Ivoz\Kam\Domain\Model\TrunksUacreg;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class DdiProviderRegistrationStatus
{
   /**
    * @var bool
    * @AttributeDefinition(type="bool")
    */
    private $registered = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $inProgress = false;

    /**
     * @var ?int
     * @AttributeDefinition(type="int", required=false)
     */
    private $expires;

    public function __construct(
        int $statusCode,
        int $expires = null
    ) {
        if ($statusCode === 20) {
            $this
                ->setRegistered(true)
                ->setExpires($expires);
        }

        if (in_array($statusCode, [24, 18], true)) {
            $this->setInProgress(true);
        }
    }

    public function toArray(): array
    {
        return [
            'registered' => $this->getRegistered(),
            'inProgress' => $this->getInProgress(),
            'expires' => $this->getExpires()
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

    public function getInProgress(): bool
    {
        return $this->inProgress;
    }

    private function setInProgress(bool $inProgress): static
    {
        $this->inProgress = $inProgress;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getExpires()
    {
        return $this->expires;
    }

    private function setExpires(?int $expires = null): static
    {
        $this->expires = $expires;

        return $this;
    }
}
