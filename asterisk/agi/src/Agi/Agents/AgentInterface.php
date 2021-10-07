<?php

namespace Agi\Agents;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
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
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface|null
     */
    public function getOutgoingDdi($destination);

    /**
     * @param Criteria|null $criteria
     * @return \Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSettingInterface[]
     */
    public function getCallForwardSettings(Criteria $criteria = null);

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

    /**
     * @return bool
     */
    public function getVoicemailEnabled();

    /**
     * @return LocutionInterface | null
     */
    public function getVoiceMailLocution();

    /**
     * @brief Determine if Agent's endpoint has T.38 Passthrough enabled
     *
     * @return boolean
     */
    public function isT38PassthroughEnabled();
}
