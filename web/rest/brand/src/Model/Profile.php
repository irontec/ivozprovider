<?php

namespace Model;

use Assert\Assertion;
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
        array $adminRelPublicEntities,
    ) {
        $this->restricted = $restricted;

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

    /**
     * @return ProfileAcl[]
     */
    public function getAcls(): array
    {
        return $this->acls;
    }
}
