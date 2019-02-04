<?php
namespace Agi\Agents;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroupInterface;

interface AgentInterface
{
    /**
     * @return string
     */
    public function __toString();

    /**
     * @param AgentInterface $other
     * @return boolean
     */
    public function isEqual(AgentInterface $other);

    /**
     * @return string
     */
    public function getType();

    /**
     * @return string
     */
    public function getId();

    /**
     * @return CompanyInterface
     */
    public function getCompany();

    /**
     * @return string
     */
    public function getLanguageCode();

    /**
     * @param string $destination
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi($destination);

    /**
     * @return string
     */
    public function getExtensionNumber();

    /**
     * @param string $destination
     * @return boolean
     */
    public function isAllowedToCall($destination);

    /**
     * @return PickUpGroupInterface[] | null
     */
    public function getPickUpGroups();

    /**
     * @return string
     */
    public function getVoiceMail();
}
