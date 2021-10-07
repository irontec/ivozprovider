<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

/**
 * InvoiceNumberSequence
 */
class InvoiceNumberSequence extends InvoiceNumberSequenceAbstract implements InvoiceNumberSequenceInterface
{
    use InvoiceNumberSequenceTrait;

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

    /**
     * Fake/Empty setter
     *
     * Version value is automatically handled by doctrine
     *
     * @inheritdoc
     */
    protected function setVersion(int $version): static
    {
        return $this;
    }

    /**
     * Update and return latest value
     *
     * @return string
     */
    public function nextval()
    {
        $iteration = $this->getIteration() + 1;
        $sequence = str_pad(
            (string) ($this->getIncrement() * $iteration),
            $this->getSequenceLength(),
            '0',
            STR_PAD_LEFT
        );

        $this->setIteration($iteration);
        $this->setLatestValue(
            $this->getPrefix() . $sequence
        );

        return $this->getLatestValue();
    }
}
