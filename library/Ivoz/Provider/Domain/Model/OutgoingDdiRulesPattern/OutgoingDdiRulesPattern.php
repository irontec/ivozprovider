<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;

/**
 * OutgoingDdiRulesPattern
 */
class OutgoingDdiRulesPattern extends OutgoingDdiRulesPatternAbstract implements OutgoingDdiRulesPatternInterface
{
    use OutgoingDdiRulesPatternTrait;

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
    public function getId()
    {
        return $this->id;
    }

    protected function sanitizeValues()
    {

        if ($this->getType() === OutgoingDdiRulesPatternInterface::TYPE_PREFIX) {
            $this->setMatchList(null);
        } elseif ($this->getType() === OutgoingDdiRulesPatternInterface::TYPE_DESTINATION) {
            $this->setPrefix(null);
        }

        $nullableFields = [
            'force' => 'forcedDdi',
        ];
        $defaultAction = $this->getAction();
        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction === $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * @param string| null $prefix
     * @return static
     * @throws \Exception
     */
    protected function setPrefix(?string $prefix = null): static
    {
        if ($this->getType() === OutgoingDdiRulesPatternInterface::TYPE_PREFIX) {
            Assertion::regex(
                $prefix,
                '/^[0-9]{1,3}[*]$/'
            );
        }

        return parent::setPrefix($prefix);
    }

    /**
     * Return forced Ddi for this rule pattern
     *
     * @return DdiInterface|null
     */
    public function getForcedDdi(): ?DdiInterface
    {
        $ddi = parent::getForcedDdi();
        if ($ddi) {
            return $ddi;
        }

        return $this
            ->getOutgoingDdiRule()
            ->getCompany()
            ->getOutgoingDdi();
    }
}
