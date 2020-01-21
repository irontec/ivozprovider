<?php

namespace Ivoz\Ast\Domain\Model\Queue;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface QueueRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return QueueInterface
     */
    public function findOneByProviderQueueId($id);
}
