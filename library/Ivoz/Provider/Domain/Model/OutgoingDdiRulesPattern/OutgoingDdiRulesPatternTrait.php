<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * OutgoingDdiRulesPatternTrait
 * @codeCoverageIgnore
 */
trait OutgoingDdiRulesPatternTrait
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
     * @return OutgoingDdiRulesPatternDTO
     */
    public static function createDTO()
    {
        return new OutgoingDdiRulesPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRulesPatternDTO
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
         * @var $dto OutgoingDdiRulesPatternDTO
         */
        parent::updateFromDTO($dto);

        return $this;
    }

    /**
     * @return OutgoingDdiRulesPatternDTO
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

