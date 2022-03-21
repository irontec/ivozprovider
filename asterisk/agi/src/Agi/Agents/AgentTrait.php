<?php

namespace Agi\Agents;

use Doctrine\Common\Collections\Criteria;

trait AgentTrait
{
    /**
     * @return string
     */
    abstract public function getType();

    /**
     * @return string
     */
    abstract public function getId();

    /**
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s#%d",
            $this->getType(),
            $this->getId()
        );
    }

    /**
     * Determine if two agents are equal
     *
     * @param AgentInterface|null $other
     * @return bool
     */
    public function isEqual(AgentInterface $other = null)
    {
        if (is_null($other)) {
            return false;
        }

        $equals = (
            $other->getType() == $this->getType()
            && $other->getId() == $this->getId()
        );

        return $equals;
    }

    public function getCallForwardSettings(Criteria $criteria = null)
    {
        return [];
    }

    public function getExtensionNumber()
    {
        return "";
    }

    public function getPickupGroups()
    {
        return null;
    }

    public function getVoicemail()
    {
        return null;
    }

    /**
     * @brief Determine if agent's endpoint has T.38 Passthrough enabled
     *
     * @return boolean
     */
    public function isT38PassthroughEnabled()
    {
        return false;
    }
}
