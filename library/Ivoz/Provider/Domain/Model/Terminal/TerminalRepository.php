<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface TerminalRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $name
     * @param DomainInterface $domain
     * @return TerminalInterface | null
     */
    public function findOneByNameAndDomain(string $name, DomainInterface $domain);

    /**
     * @return TerminalInterface | null
     */
    public function findOneByCompanyAndName(int $companyId, string $name);

    /**
     * @return TerminalInterface | null
     */
    public function findOneByMac(string $mac);

    /**
     * @param int $companyId
     * @return string[]
     */
    public function findNamesByCompanyId(int $companyId);

    /**
     * @param int[] $companyIds
     * @return int
     */
    public function countRegistrableDevices(array $companyIds): int;

    /**
     * @param int[] $includeIds
     * @return TerminalInterface[]
     */
    public function findUnassignedByCompanyId(int $companyId, array $includeIds = []): array;
}
