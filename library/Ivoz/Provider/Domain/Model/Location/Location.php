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

    /**
     * @return UserInterface[]
     */
    public function getUsers(?Criteria $criteria = null): array
    {
        return array_filter(
            $this->traitGetUsers($criteria),
            fn($u) => !is_null($u->getLocation()),
        );
    }

    /**
     * @param Collection<array-key, UserInterface> $users
     */
    public function replaceUsers(Collection $users): LocationInterface
    {
        $collectionIds = array_map(
            fn($u) => $u->getId(),
            $users->toArray(),
        );

        foreach ($this->getUsers() as $user) {
            $isRemoved = !in_array($user->getId(), $collectionIds);

            if ($isRemoved) {
                $user->setLocation(null);
            }
        }

        $currentIds = array_map(
            fn($u) => $u->getId(),
            $this->getUsers(),
        );

        foreach ($users->toArray() as $user) {
            $isAdded = !in_array($user->getId(), $currentIds);

            if ($isAdded) {
                $user->setLocation($this);
                $this->addUser($user);
            }
        }

        return $this;
    }
}
