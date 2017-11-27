<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

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
    public function getChangeSet()
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
        $nullableFields = [
            'force' => 'forcedDdi',
        ];
        $defaultAction = $this->getAction();
        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * Return forced Ddi for this rule pattern
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi()
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

