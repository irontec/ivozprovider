<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface DispatcherRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return null|DispatcherInterface
     */
    public function findOneByApplicationServerId($id);
}
