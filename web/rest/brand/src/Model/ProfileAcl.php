<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;

/**
 * @codeCoverageIgnore
 */
class ProfileAcl
{
    /**
     * @var string
     * @AttributeDefinition(type="string")
     */
    private $iden;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $create = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $read = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $update = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $delete = false;

    public function __construct(
        AdministratorRelPublicEntityInterface $administratorRelPublicEntity
    ) {
        $publicEntity = $administratorRelPublicEntity->getPublicEntity();

        $this->iden = $publicEntity->getIden();
        $this->create = $administratorRelPublicEntity->getCreate();
        $this->read = $administratorRelPublicEntity->getRead();
        $this->update = $administratorRelPublicEntity->getUpdate();
        $this->delete = $administratorRelPublicEntity->getDelete();
    }

    public function getIden(): string
    {
        return $this->iden;
    }

    public function canCreate(): bool
    {
        return $this->create;
    }

    public function canRead(): bool
    {
        return $this->read;
    }

    public function canUpdate(): bool
    {
        return $this->update;
    }

    public function canDelete(): bool
    {
        return $this->delete;
    }
}
