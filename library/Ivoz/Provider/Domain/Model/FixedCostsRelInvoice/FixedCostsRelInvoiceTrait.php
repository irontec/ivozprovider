<?php

namespace Ivoz\Provider\Domain\Model\FixedCostsRelInvoice;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * FixedCostsRelInvoiceTrait
 * @codeCoverageIgnore
 */
trait FixedCostsRelInvoiceTrait
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());

    }

    /**
     * @return FixedCostsRelInvoiceDTO
     */
    public static function createDTO()
    {
        return new FixedCostsRelInvoiceDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FixedCostsRelInvoiceDTO
         */
        $self = parent::fromDTO($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto FixedCostsRelInvoiceDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return FixedCostsRelInvoiceDTO
     */
    public function toDTO()
    {
        $dto = parent::toDTO();
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => $this->getId()
        ];
    }


}

