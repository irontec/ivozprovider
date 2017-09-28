<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * CallAclTrait
 * @codeCoverageIgnore
 */
trait CallAclTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $relPatterns;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->relPatterns = new ArrayCollection();
    }

    /**
     * @return CallAclDTO
     */
    public static function createDTO()
    {
        return new CallAclDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallAclDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getRelPatterns()) {
            $self->replaceRelPatterns($dto->getRelPatterns());
        }
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
         * @var $dto CallAclDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getRelPatterns()) {
            $this->replaceRelPatterns($dto->getRelPatterns());
        }
        return $this;
    }

    /**
     * @return CallAclDTO
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


    /**
     * Add relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern
     *
     * @return CallAclTrait
     */
    public function addRelPattern(\Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern)
    {
        $this->relPatterns->add($relPattern);

        return $this;
    }

    /**
     * Remove relPattern
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern
     */
    public function removeRelPattern(\Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface $relPattern)
    {
        $this->relPatterns->removeElement($relPattern);
    }

    /**
     * Replace relPatterns
     *
     * @param \Ivoz\Provider\Domain\Model\CallAclRelPattern\CallAclRelPatternInterface[] $relPatterns
     * @return self
     */
    public function replaceRelPatterns(Collection $relPatterns)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($relPatterns as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setCallAcl($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->relPatterns as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->relPatterns->set($key, $updatedEntities[$identity]);
            } else {
                $this->relPatterns->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addRelPattern($entity);
        }

        return $this;
    }

    /**
     * Get relPatterns
     *
     * @return array
     */
    public function getRelPatterns(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->relPatterns->matching($criteria)->toArray();
        }

        return $this->relPatterns->toArray();
    }


}

