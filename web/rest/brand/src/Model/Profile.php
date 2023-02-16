<?php

namespace Model;

use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Ivoz\Provider\Domain\Model\Feature\FeatureInterface;

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
     * @var string[]
     * @AttributeDefinition(
     *     type="array",
     *     collectionValueType="string"
     * )
     */
    private $features = [];

    /**
     * @param AdministratorRelPublicEntityInterface[] $adminRelPublicEntities
     * @param FeatureInterface[] $features
     */
    public function __construct(
        bool $restricted,
        array $adminRelPublicEntities,
        array $features
    ) {
        $this->restricted = $restricted;

        foreach ($adminRelPublicEntities as $adminRelPublicEntity) {
            $this->addAcl(
                new ProfileAcl($adminRelPublicEntity)
            );
        }

        foreach ($features as $feature) {
            $this->addFeature(
                $feature->getIden()
            );
        }
    }

    private function addAcl(ProfileAcl $acl): static
    {
        $this->acls[] = $acl;

        return $this;
    }

    private function addFeature(string $feature): static
    {
        $this->features[] = $feature;

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

    /**
     * @return string[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }
}
