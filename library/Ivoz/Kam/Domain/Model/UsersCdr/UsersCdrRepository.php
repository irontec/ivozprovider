<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface UsersCdrRepository extends ObjectRepository, Selectable
{
    /**
     * @param mixed $userId
     * @return int
     */
    public function countByUserId($userId) :int;

    /**
     * @param string $callid
     * @return UsersCdrInterface[]
     */
    public function findByCallid($callid);

    /**
     * @param string $callid
     * @return UsersCdrInterface | null
     */
    public function findOneByCallid($callid);
}
