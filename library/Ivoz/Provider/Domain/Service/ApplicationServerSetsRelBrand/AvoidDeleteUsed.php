<?php

namespace Ivoz\Provider\Domain\Service\ApplicationServerSetsRelBrand;

use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;

class AvoidDeleteUsed implements ApplicationServerSetsRelBrandLifecycleEventHandlerInterface
{
    const PRE_REMOVE_PRIORITY = 1;

    public function __construct(
        private CompanyRepository $companyRepository,
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

    public function execute(ApplicationServerSetsRelBrandInterface $applicationServerSetsRelBrand): void
    {
        $brand = $applicationServerSetsRelBrand->getBrand();

        if (is_null($brand)) {
            return;
        }

        $applicationServerSet = $applicationServerSetsRelBrand->getApplicationServerSet();

        $applicationServerSetId = $applicationServerSet->getId();
        $brandId = $brand->getId();

        if (is_null($applicationServerSetId) || is_null($brandId)) {
            return;
        }

        $companies = $this
            ->companyRepository
            ->findByApplicationServerSetIdAndBrandId(
                $applicationServerSetId,
                $brandId
            );

        if (empty($companies)) {
            return;
        }

        throw new \DomainException(
            'A application server set may not be unassociated while it is being used'
        );
    }
}
