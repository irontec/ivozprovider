<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

use Doctrine\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PublicEntityRepository extends ObjectRepository, Selectable
{

    /**
     * @return PublicEntityInterface[]
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findClientEntities(): array;

    /**
     * @return PublicEntityInterface[]
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findBrandEntities(): array;

    /**
     * @return PublicEntityInterface[]
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function findPlatformEntities(): array;
}
