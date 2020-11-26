<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Terminal;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpointInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
* @codeCoverageIgnore
*/
trait TerminalTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var ArrayCollection
     * PsEndpointInterface mappedBy terminal
     */
    protected $astPsEndpoints;

    /**
     * @var ArrayCollection
     * UserInterface mappedBy terminal
     */
    protected $users;

    /**
     * Constructor
     */
    protected function __construct()
    {
        parent::__construct(...func_get_args());
        $this->astPsEndpoints = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    abstract protected function sanitizeValues();

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        /** @var static $self */
        $self = parent::fromDto($dto, $fkTransformer);
        if (!is_null($dto->getAstPsEndpoints())) {
            $self->replaceAstPsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getAstPsEndpoints()
                )
            );
        }

        if (!is_null($dto->getUsers())) {
            $self->replaceUsers(
                $fkTransformer->transformCollection(
                    $dto->getUsers()
                )
            );
        }

        $self->sanitizeValues();
        if ($dto->getId()) {
            $self->id = $dto->getId();
            $self->initChangelog();
        }

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TerminalDto $dto
     * @param ForeignKeyTransformerInterface  $fkTransformer
     * @return static
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        parent::updateFromDto($dto, $fkTransformer);
        if (!is_null($dto->getAstPsEndpoints())) {
            $this->replaceAstPsEndpoints(
                $fkTransformer->transformCollection(
                    $dto->getAstPsEndpoints()
                )
            );
        }

        if (!is_null($dto->getUsers())) {
            $this->replaceUsers(
                $fkTransformer->transformCollection(
                    $dto->getUsers()
                )
            );
        }
        $this->sanitizeValues();

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TerminalDto
     */
    public function toDto($depth = 0)
    {
        $dto = parent::toDto($depth);
        return $dto
            ->setId($this->getId());
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return parent::__toArray() + [
            'id' => self::getId()
        ];
    }

    /**
     * Add astPsEndpoint
     *
     * @param PsEndpointInterface $astPsEndpoint
     *
     * @return static
     */
    public function addAstPsEndpoint(PsEndpointInterface $astPsEndpoint): TerminalInterface
    {
        $this->astPsEndpoints->add($astPsEndpoint);

        return $this;
    }

    /**
     * Remove astPsEndpoint
     *
     * @param PsEndpointInterface $astPsEndpoint
     *
     * @return static
     */
    public function removeAstPsEndpoint(PsEndpointInterface $astPsEndpoint): TerminalInterface
    {
        $this->astPsEndpoints->removeElement($astPsEndpoint);

        return $this;
    }

    /**
     * Replace astPsEndpoints
     *
     * @param ArrayCollection $astPsEndpoints of PsEndpointInterface
     *
     * @return static
     */
    public function replaceAstPsEndpoints(ArrayCollection $astPsEndpoints): TerminalInterface
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
     * @param Criteria | null $criteria
     * @return PsEndpointInterface[]
     */
    public function getAstPsEndpoints(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->astPsEndpoints->matching($criteria)->toArray();
        }

        return $this->astPsEndpoints->toArray();
    }

    /**
     * Add user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function addUser(UserInterface $user): TerminalInterface
    {
        $this->users->add($user);

        return $this;
    }

    /**
     * Remove user
     *
     * @param UserInterface $user
     *
     * @return static
     */
    public function removeUser(UserInterface $user): TerminalInterface
    {
        $this->users->removeElement($user);

        return $this;
    }

    /**
     * Replace users
     *
     * @param ArrayCollection $users of UserInterface
     *
     * @return static
     */
    public function replaceUsers(ArrayCollection $users): TerminalInterface
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
     * @param Criteria | null $criteria
     * @return UserInterface[]
     */
    public function getUsers(Criteria $criteria = null): array
    {
        if (!is_null($criteria)) {
            return $this->users->matching($criteria)->toArray();
        }

        return $this->users->toArray();
    }

}
