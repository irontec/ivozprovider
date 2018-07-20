<?php

namespace Ivoz\Provider\Domain\Model\RatingProfile;

/**
 * RatingProfile
 */
class RatingProfile extends RatingProfileAbstract implements RatingProfileInterface
{
    use RatingProfileTrait;

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

