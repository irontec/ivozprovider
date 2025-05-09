<?php

namespace Ivoz\Provider\Domain\Model\Location;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use phpDocumentor\Reflection\Types\Expression;

/**
 * Location
 */
class Location extends LocationAbstract implements LocationInterface
{
    use LocationTrait {
        replaceUsers as traitReplaceUsers;
        getUsers as traitGetUsers;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }
}
