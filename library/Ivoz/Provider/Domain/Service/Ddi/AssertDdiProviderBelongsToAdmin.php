<?php

namespace Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;

class AssertDdiProviderBelongsToAdmin
{
    public function __construct(
        private DdiProviderRepository $ddiProviderRepository
    ) {
    }

    /**
     * @throws \DomainException
     */
    public function execute(
        AdministratorInterface $admin,
        DdiProviderInterface $ddiProvider
    ): void {
        $brandDdiProviderIds = $this
            ->ddiProviderRepository
            ->getDdiProviderIdsByBrandAdmin($admin);

        $isBrandDdiProvider = in_array((int) $ddiProvider->getId(), $brandDdiProviderIds, true);
        if (!$isBrandDdiProvider) {
            throw new \DomainException(
                'DDI provider not found',
                404
            );
        }
    }
}
