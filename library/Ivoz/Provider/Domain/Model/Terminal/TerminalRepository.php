<?php

namespace Ivoz\Provider\Domain\Model\Terminal;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\Common\Collections\Selectable;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;

interface TerminalRepository extends ObjectRepository, Selectable
{
    /**
     * @param string $name
     * @param DomainInterface $domain
     * @return TerminalInterface | null
     */
    public function findOneByNameAndDomain(string $name, DomainInterface $domain);
}
