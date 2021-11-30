<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelMatchlist;

class ConditionalRoutesConditionsRelMatchlist extends ConditionalRoutesConditionsRelMatchlistAbstract implements ConditionalRoutesConditionsRelMatchlistInterface
{
    use ConditionalRoutesConditionsRelMatchlistTrait;

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
}
