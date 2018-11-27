<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

class InvoiceNumberSequenceDto extends InvoiceNumberSequenceDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'latestValue' => 'latestValue'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

    /**
     * @inheritdoc
     */
    public function setIteration($iteration = null)
    {
        if ($this->getId()) {
            //Do not update this value
            return $this;
        }

        return parent::setIteration($iteration);
    }

    /**
     * @inheritdoc
     */
    public function setLatestValue($latestValue = null)
    {
        if ($this->getId()) {
            //Do not update this value
            return $this;
        }

        return parent::setLatestValue($latestValue);
    }

    /**
     * @inheritdoc
     */
    public function setVersion($version = null)
    {
        if ($this->getId()) {
            //Do not update this value
            return $this;
        }

        return parent::setVersion($version);
    }
}
