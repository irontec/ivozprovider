<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

/**
 * AdministratorRelPublicEntity
 */
class AdministratorRelPublicEntity extends AdministratorRelPublicEntityAbstract implements AdministratorRelPublicEntityInterface
{
    use AdministratorRelPublicEntityTrait;

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
    public function getId(): ?int
    {
        return $this->id;
    }
}
