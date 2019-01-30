<?php

namespace Agi\Agents;

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

    public function getExtensionNumber()
    {
        return "";
    }

    public function getPickupGroups()
    {
        return null;
    }

    public function getVoiceMail()
    {
        return null;
    }
}
