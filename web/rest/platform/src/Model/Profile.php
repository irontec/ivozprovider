<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;

/**
 * @codeCoverageIgnore
 */
class Profile
{
    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $restricted;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $canImpersonate;

    /**
     * @var ProfileAcl[]
     * @AttributeDefinition(
     *     type="array",
     *     class="Model\ProfileAcl"
     * )
     */
    private $acls = [];

    /**
     * @param AdministratorRelPublicEntityInterface[] $adminRelPublicEntities
     */
    public function __construct(
        bool $restricted,
        bool $canImpersonate,
        array $adminRelPublicEntities,
    ) {
        $this->restricted = $restricted;
        $this->canImpersonate = $canImpersonate;

        foreach ($adminRelPublicEntities as $adminRelPublicEntity) {
            $this->addAcl(
                new ProfileAcl($adminRelPublicEntity)
            );
        }
    }

    private function addAcl(ProfileAcl $acl): static
    {
        $this->acls[] = $acl;

        return $this;
    }

    public function isRestricted(): bool
    {
        return $this->restricted;
    }

    public function isCanImpersonate(): bool
    {
        return $this->canImpersonate;
    }

    /**
     * @return ProfileAcl[]
     */
    public function getAcls(): array
    {
        return $this->acls;
    }
}
