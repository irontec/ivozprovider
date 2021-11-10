<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

/**
 * PublicEntity
 */
class PublicEntity extends PublicEntityAbstract implements PublicEntityInterface
{
    use PublicEntityTrait;

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
