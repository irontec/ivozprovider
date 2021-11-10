<?php

namespace Ivoz\Provider\Domain\Model\BillableCallHistoric;

/**
 * BillableCallHistoric
 */
class BillableCallHistoric extends BillableCallHistoricAbstract implements BillableCallHistoricInterface
{
    use BillableCallHistoricTrait;

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
