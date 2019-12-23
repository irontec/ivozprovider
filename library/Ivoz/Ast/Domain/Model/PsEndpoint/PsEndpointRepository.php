<?php

namespace Ivoz\Ast\Domain\Model\PsEndpoint;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectRepository;

interface PsEndpointRepository extends ObjectRepository, Selectable
{
    /**
     * @param int $id
     * @return null|PsEndpointInterface
     */
    public function findOneByFriendId($id);

    /**
     * @param int $id
     * @return null|PsEndpointInterface
     */
    public function findOneByResidentialDeviceId($id);

    /**
     * @param int $id
     * @return null|PsEndpointInterface
     */
    public function findOneByRetailAccountId($id);

    /**
     * @param int $id
     * @return null|PsEndpointInterface
     */
    public function findOneByTerminalId($id);

    /**
     * @param string $sorceryId
     * @return PsEndpointInterface | null
     */
    public function findOneBySorceryId($sorceryId);
}
