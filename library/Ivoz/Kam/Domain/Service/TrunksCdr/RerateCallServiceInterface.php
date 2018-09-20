<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

interface RerateCallServiceInterface
{
    /**
     * @param array $pks
     * @return void
     * @throws \DomainException
     */
    public function execute(array $pks);
}
