<?php

namespace DataFixtures\Stub;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Service\Assembler\EntityAssembler;
use Ivoz\Core\Domain\Model\EntityInterface;

trait StubTrait
{
    /** @var bool  */
    private $loaded = false;
    private $items = [];
    private $entityAssembler;

    public function __construct(
        EntityAssembler $entityAssembler
    ) {
        $this->entityAssembler = $entityAssembler;
    }

    abstract protected function load();
    abstract protected function getEntityName(): string;

    protected function append(DataTransferObjectInterface $dto)
    {
        $entity = $this->entityAssembler->createFromDto(
            $dto,
            $this->getEntityName()
        );
        $entityId = $entity->getId();

        if (array_key_exists($entityId, $this->items)) {
            throw new \Exception(
                $entity->__toString() . ' already exists'
            );
        }

        $this->items[$entityId] = $entity;
    }

    public function getAll(): array
    {
        if (!$this->loaded) {
            $this->load();
            $this->loaded = true;
        }

        return $this->items;
    }

    public function get(int $idx): EntityInterface
    {
        if (!$this->loaded) {
            $this->load();
            $this->loaded = true;
        }

        return $this->items[$idx];
    }
}
