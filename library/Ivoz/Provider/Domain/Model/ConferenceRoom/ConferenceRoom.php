<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

/**
 * ConferenceRoom
 */
class ConferenceRoom extends ConferenceRoomAbstract implements ConferenceRoomInterface
{
    use ConferenceRoomTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
        if (!$this->getPinProtected()) {
            $this->setPinCode(null);
        }
    }
}
