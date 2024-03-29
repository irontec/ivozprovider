<?php

namespace Agi\Agents;

use Agi\Wrapper;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;

/** @psalm-suppress UnusedProperty */
class FaxAgent implements AgentInterface
{
    use AgentTrait;

    private $agi;
    private $fax;

    public function __construct(
        Wrapper $agi,
        FaxInterface $user
    ) {
        $this->agi = $agi;
        $this->fax = $user;
    }

    public function getType()
    {
        return "Fax";
    }

    public function getId()
    {
        return $this->fax->getId();
    }

    public function getCompany()
    {
        return $this->fax->getCompany();
    }

    public function getLanguageCode()
    {
        return $this->getCompany()->getLanguageCode();
    }

    public function getOutgoingDdi($destination)
    {
        // Get default fax outgoing DDI
        return  $this->fax->getOutgoingDDI();
    }

    /**
     * @param string $destination
     * @return boolean
     */
    public function isAllowedToCall($destination)
    {
        return true;
    }
}
