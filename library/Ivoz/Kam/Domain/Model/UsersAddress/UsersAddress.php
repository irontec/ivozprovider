<?php

namespace Ivoz\Kam\Domain\Model\UsersAddress;

use Ivoz\Core\Domain\Assert\Assertion;

/**
 * UsersAddres
 */
class UsersAddress extends UsersAddressAbstract implements UsersAddressInterface
{
    use UsersAddressTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {
        $address = explode('/', $this->getSourceAddress());
        $ip = array_shift($address);
        $mask = array_shift($address);

        // Save validated values
        $this->setIpAddr($ip);
        $this->setMask($mask);
    }

    public function setIpAddr(?string $ipAddr = null): self
    {
        if (!is_null($ipAddr)) {
            Assertion::ip($ipAddr);
        }

        return parent::setIpAddr($ipAddr);
    }

    public function setMask(int $mask = null): self
    {
        $mask = $mask ?? 32;

        if ($mask < 0 || $mask > 32) {
            throw new \DomainException('Wrong mask, discarding value.', 70001);
        }

        return parent::setMask($mask);
    }
}
