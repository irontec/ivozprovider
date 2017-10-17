<?php

namespace Ivoz\Core\Infrastructure\Domain\Service;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineEntityPersister implements EntityPersisterInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;

    public function __construct
    (
        EntityManagerInterface $em,
        CreateEntityFromDTO $createEntityFromDTO,
        UpdateEntityFromDTO $entityUpdater
    ) {
        $this->em = $em;
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->entityUpdater = $entityUpdater;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @param EntityInterface|null $entity
     * @return EntityInterface|mixed
     */
    public function persistDto(DataTransferObjectInterface $dto, EntityInterface $entity = null, $dispatchImmediately = true)
    {
        if (is_null($entity)) {
            $entityClass = substr(get_class($dto), 0, -3);
            $entity = $this
                ->createEntityFromDTO
                ->execute($entityClass, $dto);

            $this->em->persist($entity);

        } else {
            $this->entityUpdater->execute($entity, $dto);
        }

        if ($dispatchImmediately) {
            $this->em->flush($entity);
        }

        return $entity;
    }

    /**
     * @param EntityInterface $entity
     *
     * @param boolean $dispatchImmediately
     * @return void
     */
    public function persist(EntityInterface $entity = null, $dispatchImmediately = true)
    {
        $this->em->persist($entity);
        if ($dispatchImmediately) {
            $this->em->flush($entity);
        }
    }

    /**
     * @param EntityInterface $entity
     * @return void
     */
    public function remove(EntityInterface $entity)
    {
        $this->em->remove($entity);

    }
}