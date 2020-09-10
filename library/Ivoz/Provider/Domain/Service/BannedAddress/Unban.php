<?php

namespace Ivoz\Provider\Domain\Service\BannedAddress;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Infrastructure\Gearman\UsersClient;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressInterface;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressRepository;

class Unban
{
    protected $entityTools;
    protected $bannedAddressRepository;
    protected $kamUsersClient;

    public function __construct(
        EntityTools $entityTools,
        BannedAddressRepository $bannedAddressRepository,
        UsersClient $kamUsersClient
    ) {
        $this->entityTools = $entityTools;
        $this->bannedAddressRepository = $bannedAddressRepository;
        $this->kamUsersClient = $kamUsersClient;
    }

    public function execute(int $pk) :bool
    {
        /** @var BannedAddressInterface | null $bannedAddress */
        $bannedAddress = $this->bannedAddressRepository->find($pk);
        if (!$bannedAddress) {
            throw new \DomainException(sprintf(
                'Banned address #%d was not found',
                $pk
            ));
        }

        try {
            $this->kamUsersClient->unban(
                $bannedAddress->getAor(),
                $bannedAddress->getIp()
            );
        } catch (\Exception $e) {
            return false;
        }

        $this->entityTools->remove($bannedAddress);

        return true;
    }
}
