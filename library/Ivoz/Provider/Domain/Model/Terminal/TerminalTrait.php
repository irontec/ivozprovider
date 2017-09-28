<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;

/**
 * TerminalTrait
 * @codeCoverageIgnore
 */
trait TerminalTrait
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var Collection
     */
    protected $astPsEndpoints;

    /**
     * @var Collection
     */
    protected $users;


    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct(...func_get_args());
        $this->astPsEndpoints = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    /**
     * @return TerminalDTO
     */
    public static function createDTO()
    {
        return new TerminalDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TerminalDTO
         */
        $self = parent::fromDTO($dto);
        if ($dto->getAstPsEndpoints()) {
            $self->replaceAstPsEndpoints($dto->getAstPsEndpoints());
        }

        if ($dto->getUsers()) {
            $self->replaceUsers($dto->getUsers());
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
         * @var $dto TerminalDTO
         */
        parent::updateFromDTO($dto);
        if ($dto->getAstPsEndpoints()) {
            $this->replaceAstPsEndpoints($dto->getAstPsEndpoints());
        }
        if ($dto->getUsers()) {
            $this->replaceUsers($dto->getUsers());
        }
        return $this;
    }

    /**
     * @return TerminalDTO
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
     * Add astPsEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint
     *
     * @return TerminalTrait
     */
    public function addAstPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint)
    {
        $this->astPsEndpoints->add($astPsEndpoint);

        return $this;
    }

    /**
     * Remove astPsEndpoint
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint
     */
    public function removeAstPsEndpoint(\Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface $astPsEndpoint)
    {
        $this->astPsEndpoints->removeElement($astPsEndpoint);
    }

    /**
     * Replace astPsEndpoints
     *
     * @param \Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface[] $astPsEndpoints
     * @return self
     */
    public function replaceAstPsEndpoints(Collection $astPsEndpoints)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($astPsEndpoints as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setTerminal($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->astPsEndpoints as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->astPsEndpoints->set($key, $updatedEntities[$identity]);
            } else {
                $this->astPsEndpoints->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addAstPsEndpoint($entity);
        }

        return $this;
    }

    /**
     * Get astPsEndpoints
     *
     * @return array
     */
    public function getAstPsEndpoints(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->astPsEndpoints->matching($criteria)->toArray();
        }

        return $this->astPsEndpoints->toArray();
    }

    /**
     * Add user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return TerminalTrait
     */
    public function addUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->add($user);

        return $this;
    }

    /**
     * Remove user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     */
    public function removeUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Replace users
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface[] $users
     * @return self
     */
    public function replaceUsers(Collection $users)
    {
        $updatedEntities = [];
        $fallBackId = -1;
        foreach ($users as $entity) {
            $index = $entity->getId() ? $entity->getId() : $fallBackId--;
            $updatedEntities[$index] = $entity;
            $entity->setTerminal($this);
        }
        $updatedEntityKeys = array_keys($updatedEntities);

        foreach ($this->users as $key => $entity) {
            $identity = $entity->getId();
            if (in_array($identity, $updatedEntityKeys)) {
                $this->users->set($key, $updatedEntities[$identity]);
            } else {
                $this->users->remove($key);
            }
            unset($updatedEntities[$identity]);
        }

        foreach ($updatedEntities as $entity) {
            $this->addUser($entity);
        }

        return $this;
    }

    /**
     * Get users
     *
     * @return array
     */
    public function getUsers(Criteria $criteria = null)
    {
        if (!is_null($criteria)) {
            return $this->users->matching($criteria)->toArray();
        }

        return $this->users->toArray();
    }


}

