<?php

namespace Ivoz\Provider\Domain\Model\Contact;

/**
 * Contact
 */
class Contact extends ContactAbstract implements ContactInterface
{
    use ContactTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
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
}
