<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class RegistrationStatus
{
   /**
    * @var string
    * @AttributeDefinition(type="string")
    */
    protected $contact;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $expires;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    protected $userAgent;

    public function __construct(
        UsersLocationInterface $location = null,
        \DateTimeZone $timeZone = null
    ) {
        if (!$location) {
            return;
        }

        $expires = $timeZone
            ? $location->getExpires()->setTimezone($timeZone)
            : $location->getExpires();

        $this
            ->setContact(
                $location->getContact()
            )
            ->setExpires(
                $expires->format('Y-m-d H:i:s')
            )
            ->setUserAgent(
                $location->getUserAgent()
            );
    }

    public function toArray(): array
    {
        return [
            'contact' => $this->getContact(),
            'expires' => $this->getExpires(),
            'userAgent' => $this->getUserAgent()
        ];
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    private function setContact(string $contact): static
    {
        $this->contact = $contact;
        return $this;
    }

    public function getExpires(): string
    {
        return $this->expires;
    }

    private function setExpires(string $expires): static
    {
        $this->expires = $expires;
        return $this;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    private function setUserAgent(string $userAgent): static
    {
        $this->userAgent = $userAgent;
        return $this;
    }
}
