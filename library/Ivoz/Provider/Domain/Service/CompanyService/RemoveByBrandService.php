<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Service\BrandService\BrandServiceLifecycleEventHandlerInterface;

class RemoveByBrandService implements BrandServiceLifecycleEventHandlerInterface
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CompanyRepository
     */
    protected $companyRepository;

    /**
     * @var CompanyServiceRepository
     */
    protected $companyServiceRepository;

    function __construct(
        EntityTools $entityTools,
        CompanyRepository $companyRepository,
        CompanyServiceRepository $companyServiceRepository
    ) {
        $this->entityTools = $entityTools;
        $this->companyRepository = $companyRepository;
        $this->companyServiceRepository = $companyServiceRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_REMOVE => 10
        ];
    }

    public function execute(BrandServiceInterface $entity)
    {
        /**
         * @todo consider performance issues here
         */
        $companies = $this->companyRepository->findByBrandId(
            $entity->getBrand()->getId()
        );

        /**
         * Foreach Company in Service Brand
         * @var Company $company
         */
        foreach ($companies as $company) {
            $companyService = $this->companyServiceRepository->findCompanyService(
                $company->getId(),
                $entity->getService()->getId()
            );

            // Delete custom company service code
            if ($companyService) {
                $this->entityTools->remove($companyService);
            }
        }
    }
}
