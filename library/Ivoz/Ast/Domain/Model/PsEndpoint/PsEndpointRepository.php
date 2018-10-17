<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;

interface PsEndpointRepository extends ObjectRepository, Selectable
{
    /**
     * @param $id
     * @return null|PsEndpointInterface
     */
    public function findOneByFriendId($id);

    /**
     * @param $id
     * @return null|PsEndpointInterface
     */
    public function findOneByResidentialDeviceId($id);

    /**
     * @param $id
     * @return null|PsEndpointInterface
     */
    public function findOneByTerminalId($id);

    /**
     * @param $sorceryId
     * @return PsEndpointInterface | null
     */
    public function findOneBySorceryId($sorceryId);
}
