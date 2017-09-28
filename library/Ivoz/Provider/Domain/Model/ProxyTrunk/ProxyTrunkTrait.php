<?php

namespace Ivoz\Provider\Domain\Model\ProxyTrunk;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * ProxyTrunkTrait
 * @codeCoverageIgnore
 */
trait ProxyTrunkTrait
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
     * @return ProxyTrunkDTO
     */
    public static function createDTO()
    {
        return new ProxyTrunkDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ProxyTrunkDTO
         */
        $self = parent::fromDTO($dto);

        if ($dto->getId()) {
            $self->id = $dto->getId();
        }
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto ProxyTrunkDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return ProxyTrunkDTO
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

