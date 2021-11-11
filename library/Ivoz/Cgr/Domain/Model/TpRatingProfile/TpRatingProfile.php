<?php

namespace Ivoz\Cgr\Domain\Model\TpRatingProfile;

/**
 * TpRatingProfile
 */
class TpRatingProfile extends TpRatingProfileAbstract implements TpRatingProfileInterface
{
    use TpRatingProfileTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }
}
