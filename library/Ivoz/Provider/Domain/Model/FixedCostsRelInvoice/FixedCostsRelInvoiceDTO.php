<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class FixedCostsRelInvoiceDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $quantity;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $brandId;

    /**
     * @var mixed
     */
    private $fixedCostId;

    /**
     * @var mixed
     */
    private $invoiceId;

    /**
     * @var mixed
     */
    private $brand;

    /**
     * @var mixed
     */
    private $fixedCost;

    /**
     * @var mixed
     */
    private $invoice;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'quantity' => $this->getQuantity(),
            'id' => $this->getId(),
            'brandId' => $this->getBrandId(),
            'fixedCostId' => $this->getFixedCostId(),
            'invoiceId' => $this->getInvoiceId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
        $this->fixedCost = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\FixedCost\\FixedCost', $this->getFixedCostId());
        $this->invoice = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Invoice\\Invoice', $this->getInvoiceId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $quantity
     *
     * @return FixedCostsRelInvoiceDTO
     */
    public function setQuantity($quantity = null)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $id
     *
     * @return FixedCostsRelInvoiceDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $brandId
     *
     * @return FixedCostsRelInvoiceDTO
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $fixedCostId
     *
     * @return FixedCostsRelInvoiceDTO
     */
    public function setFixedCostId($fixedCostId)
    {
        $this->fixedCostId = $fixedCostId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFixedCostId()
    {
        return $this->fixedCostId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\FixedCost\FixedCost
     */
    public function getFixedCost()
    {
        return $this->fixedCost;
    }

    /**
     * @param integer $invoiceId
     *
     * @return FixedCostsRelInvoiceDTO
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Invoice\Invoice
     */
    public function getInvoice()
    {
        return $this->invoice;
    }
}


