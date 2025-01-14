<?php

namespace Ivoz\Provider\Domain\Service\MediaRelaySetsRelBrand;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\ORM\UnitOfWork;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\MediaRelaySet\MediaRelaySetInterface;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrandInterface;

class AvoidDeleteUsed implements MediaRelaySetsRelBrandHandlerInterface
{
    const PRE_REMOVE_PRIORITY = self::PRIORITY_NORMAL;

    public function __construct(
        private CompanyRepository $companyRepository,
        private DdiProviderRepository $ddiProviderRepository,
        private CarrierRepository $carrierRepository
    ) {
    }

    /**
     * @return array<string, int>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            self::EVENT_PRE_REMOVE => self::PRE_REMOVE_PRIORITY,
        ];
    }

    public function execute(MediaRelaySetsRelBrandInterface $mediaRelaySetsRelBrand): void
    {
        $brand = $mediaRelaySetsRelBrand->getBrand();

        if (is_null($brand)) {
            return;
        }

        $brandId = $brand->getId();
        if (is_null($brandId)) {
            return;
        }

        $mediaRelaySet = $mediaRelaySetsRelBrand->getMediaRelaySet();
        $mediaRelaySetId = $mediaRelaySet->getId();
        if (is_null($mediaRelaySetId)) {
            return;
        }

        $this->assertUnusedInCompanies($mediaRelaySetId, $brandId);
        $this->assertUnusedInDdiProviders($mediaRelaySetId, $brandId);
        $this->assertUnusedInCarriers($mediaRelaySetId, $brandId);
    }

    private function assertUnusedInCompanies(int $mediaRelaySetId, int $brandId): void
    {
        $companies = $this
            ->companyRepository
            ->findByMediaRelaySetIdAndBrandId(
                $mediaRelaySetId,
                $brandId
            );

        if (empty($companies)) {
            return;
        }

        throw new \DomainException(
            'A media relay set may not be unassociated while it is being used'
        );
    }

    private function assertUnusedInDdiProviders(int $mediaRelaySetId, int $brandId): void
    {
        $ddiProviders = $this
            ->ddiProviderRepository
            ->findByMediaRelaySetIdAndBrandId(
                $mediaRelaySetId,
                $brandId
            );

        if (empty($ddiProviders)) {
            return;
        }

        throw new \DomainException(
            'A media relay set may not be unassociated while it is being used'
        );
    }

    private function assertUnusedInCarriers(int $mediaRelaySetId, int $brandId): void
    {
        $carriers = $this
            ->carrierRepository
            ->findByMediaRelaySetIdAndBrandId(
                $mediaRelaySetId,
                $brandId
            );

        if (empty($carriers)) {
            return;
        }

        throw new \DomainException(
            'A media relay set may not be unassociated while it is being used'
        );
    }
}
