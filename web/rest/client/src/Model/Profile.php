<?php

namespace Model;

use Assert\Assertion;
use Ivoz\Api\Core\Annotation\AttributeDefinition;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
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
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $pbx = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $residential = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $retail = false;

    /**
     * @var bool
     * @AttributeDefinition(type="bool")
     */
    private $wholesale = false;

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
     * @param string[] $features
     */
    public function __construct(
        bool $restricted,
        string $type,
        array $adminRelPublicEntities,
        array $features
    ) {
        $this->restricted = $restricted;
        $this->setType($type);

        foreach ($adminRelPublicEntities as $adminRelPublicEntity) {
            $this->addAcl(
                new ProfileAcl($adminRelPublicEntity)
            );
        }

        foreach ($features as $feature) {
            $this->addFeature($feature);
        }
    }

    private function setType(string $type): static
    {
        Assertion::choice(
            $type,
            [
                CompanyInterface::TYPE_VPBX,
                CompanyInterface::TYPE_RETAIL,
                CompanyInterface::TYPE_WHOLESALE,
                CompanyInterface::TYPE_RESIDENTIAL,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        switch ($type) {
            case CompanyInterface::TYPE_VPBX:
                $this->pbx = true;
                break;
            case CompanyInterface::TYPE_RETAIL:
                $this->retail = true;
                break;
            case CompanyInterface::TYPE_WHOLESALE:
                $this->wholesale = true;
                break;
            case CompanyInterface::TYPE_RESIDENTIAL:
                $this->residential = true;
                break;
        }

        return $this;
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

    public function isPbx(): bool
    {
        return $this->pbx;
    }

    public function isResidential(): bool
    {
        return $this->residential;
    }

    public function isRetail(): bool
    {
        return $this->retail;
    }

    public function isWholesale(): bool
    {
        return $this->wholesale;
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
