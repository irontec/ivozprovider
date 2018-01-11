<?php

namespace Ivoz\Provider\Domain\Service\CompanyService;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Provider\Domain\Model\BrandService\BrandServiceInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyServiceRepository;
use Ivoz\Provider\Domain\Service\BrandService\BrandServiceLifecycleEventHandlerInterface;

/**
 * Class RemoveByBrandService
 * @lifecycle post_remove
 */
class RemoveByBrandService implements BrandServiceLifecycleEventHandlerInterface
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

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
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister,
        CompanyRepository $companyRepository,
        CompanyServiceRepository $companyServiceRepository
    ) {
        $this->em = $em;
        $this->entityPersister = $entityPersister;
        $this->companyRepository = $companyRepository;
        $this->companyServiceRepository = $companyServiceRepository;
    }

    public function execute(BrandServiceInterface $entity, $isNew)
    {
        /**
         * @todo consider performance issues here
         */
        $companies = $this->companyRepository->findBy([
            'brand' => $entity->getBrand()->getId()
        ]);

        /**
         * Foreach Company in Service Brand
         * @var Company $company
         */
        foreach ($companies as $company) {

            $companyService = $this->companyServiceRepository->findOneBy([
                'company' => $company->getId(),
                'service' => $entity->getService()->getId()
            ]);

            // Delete custom company service code
            if ($companyService) {
                $this->em->remove($companyService);
            }
        }
    }
}