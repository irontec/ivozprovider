<?php

namespace Ivoz\Kam\Domain\Model\UsersLocation;

/**
 * UsersLocation
 */
class UsersLocation extends UsersLocationAbstract implements UsersLocationInterface
{
    use UsersLocationTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getContactSrc()
    {
        $src = explode('@', $this->getContact());
        return array_pop($src);
    }

    public function getReceivedSrc()
    {
        $src = explode('sip:', $this->getReceived());
        return array_pop($src);
    }
}

