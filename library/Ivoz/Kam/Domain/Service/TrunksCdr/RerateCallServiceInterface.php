<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

interface RerateCallServiceInterface
{
    /**
     * @param array<int> $pks
     * @return void
     * @throws \DomainException
     */
    public function execute(array $pks);
}
