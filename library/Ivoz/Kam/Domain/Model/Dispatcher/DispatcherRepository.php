<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;

interface DispatcherRepository extends ObjectRepository, Selectable
{
    /**
     * @return DispatcherInterface[]
     */
    public function findByApplicationServerId(int $id): array;

    public function findOneByApplicationServerSetRelApplicationServer(int $id): ?DispatcherInterface;
}
