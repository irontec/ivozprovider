<?php

namespace Ivoz\Kam\Domain\Model\Dispatcher;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface DispatcherRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return null|DispatcherInterface
     */
    public function findOneByApplicationServerId($id);
}
