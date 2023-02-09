<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

use Ivoz\Api\Core\Annotation\AttributeDefinition;

class RegistrationStatus
{
   /**
    * @var string
    * @AttributeDefinition(type="string")
    */
    private $contact;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $publicContact;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $received;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $publicReceived;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $expires;

    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $userAgent;

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
            ->setReceived(
                $location->getReceived()
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
            'publicContact' => $this->isPublicContact(),
            'received' => $this->getReceived(),
            'publicReceived' => $this->isPublicReceived(),
            'expires' => $this->getExpires(),
            'userAgent' => $this->getUserAgent()
        ];
    }

    public function getContact(): string
    {
        return $this->contact;
    }

    public function isPublicContact(): bool
    {
        return $this->publicContact;
    }

    private function setContact(string $contact): static
    {
        $this->contact = $contact;

        preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $contact, $matches);
        $this->publicContact = !$this->isRFC1918(
            $matches['domain']
        );

        return $this;
    }

    public function getReceived(): string
    {
        return $this->received;
    }

    private function setReceived(?string $received): static
    {
        $this->received = $received ?? '';

        preg_match('/sips?:([^@]+@)?(?P<domain>[^;]+)/', $this->received, $matches);
        $this->publicReceived = $received && !$this->isRFC1918(
            $matches['domain']
        );

        return $this;
    }

    public function isPublicReceived(): bool
    {
        return $this->publicReceived;
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

    /***
     * Check if given source in IP(:PORT) format is private
     */
    private function isRFC1918(?string $src): bool
    {
        if (!$src) {
            return false;
        }

        list ($ip) = explode(
            ':',
            $src
        );

        $privateAddresses = array (
            '10.0.0.0|10.255.255.255', // single class A network
            '172.16.0.0|172.31.255.255', // 16 contiguous class B network
            '192.168.0.0|192.168.255.255', // 256 contiguous class C network
            '169.254.0.0|169.254.255.255', // Link-local address also refered to as Automatic Private IP Addressing
            '127.0.0.0|127.255.255.255' // localhost
        );

        $longIp = ip2long($ip);
        if ($longIp != -1) {
            foreach ($privateAddresses as $privateAddress) {
                list ($start, $end) = explode('|', $privateAddress);

                if ($longIp >= ip2long($start) && $longIp <= ip2long($end)) {
                    return true;
                }
            }
        }

        return false;
    }
}
