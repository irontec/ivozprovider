<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\HuntGroupMember\HuntGroupMember;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * HuntGroup
 */
class HuntGroup extends HuntGroupAbstract implements HuntGroupInterface
{
    use HuntGroupTrait;
    use RoutableTrait;

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

    protected function sanitizeValues(): void
    {
        $this->sanitizeRouteValues('NoAnswer');

        $isRingAll = $this->getStrategy() === HuntGroupInterface::STRATEGY_RINGALL;
        $nullTimeout = is_null($this->getRingAllTimeout());
        if ($isRingAll && $nullTimeout) {
            throw new \DomainException('Empty ring all timeout');
        }
    }

    /**
     * @return string
     */
    public function getNoAnswerRouteType(): ?string
    {
        return $this->getNoAnswerTargetType();
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoAnswerNumberValueE164()
    {
        if (!$this->getNoAnswerNumberCountry()) {
            return "";
        }

        return
            $this->getNoAnswerNumberCountry()->getCountryCode() .
            $this->getNoAnswerNumberValue();
    }

    /**
     * Determine if the Hunt group can be considered 'simple'
     */
    public function isSimple(): bool
    {
        $allowCallForwards = $this->getAllowCallForwards();
        if ($allowCallForwards) {
            return false;
        }

        $huntGroupMembers = $this->getHuntGroupMembers();
        foreach ($huntGroupMembers as $huntGroupMember) {
            $huntGroupMemberRouteType = $huntGroupMember->getRouteType();
            if ($huntGroupMemberRouteType == HuntGroupMember::ROUTETYPE_NUMBER) {
                return false;
            }
        }

        return true;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        if ($company->getType() !== CompanyInterface::TYPE_VPBX) {
            throw new \DomainException('HuntGroup can only be associated with vpbx companies');
        }

        return parent::setCompany($company);
    }
}
