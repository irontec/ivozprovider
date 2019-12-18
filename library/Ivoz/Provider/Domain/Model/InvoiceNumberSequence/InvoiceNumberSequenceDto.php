<?php

namespace Ivoz\Provider\Domain\Model\InvoiceNumberSequence;

class InvoiceNumberSequenceDto extends InvoiceNumberSequenceDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'latestValue' => 'latestValue'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
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
