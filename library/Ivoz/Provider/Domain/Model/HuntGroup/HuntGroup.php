<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Doctrine\Common\Collections\Criteria;
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
}
