<?php

namespace Ivoz\Kam\Domain\Model\TrunksDialplan;

use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * TrunksDialplan
 */
class TrunksDialplan extends TrunksDialplanAbstract implements TrunksDialplanInterface
{
    use TrunksDialplanTrait {
        fromDTO as protected __traitFromDTO;
        updateFromDTO as protected __traitUpdateFromDTO;
    }

    /**
     * @var string
     */
    private $parentReferenceField;

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return TrunksDialplanDTO
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        $dto->setSubstExp(
            $dto->getMatchExp()
        );

        $entity = self::__traitFromDTO(
            ...func_get_args()
        );
        $entity->parentReferenceField = $dto->getParentReferenceField();

        return $entity;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        $dto->setSubstExp(
            $dto->getMatchExp()
        );

        $entity = self::__traitUpdateFromDTO(
            ...func_get_args()
        );
        $entity->parentReferenceField = $dto->getParentReferenceField();

        return $entity;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getParentReferenceField()
    {
        return $this->parentReferenceField;
    }


    /**
     * Set dpid
     *
     * Dpid value es resolved on entity lifecycle events
     * let this be null until then
     *
     * @param integer $dpid
     *
     * @return self
     */
    public function setDpid($dpid = null)
    {
        if (!is_null($dpid)) {
            parent::setDpid($dpid);
        }

        return $this;
    }
}

