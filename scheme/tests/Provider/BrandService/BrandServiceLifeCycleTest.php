<?php

namespace Tests\Provider\BrandService;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;

class BrandServiceLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function deleting_brandService_removes_companyService()
    {
        $brandServiceRepository = $this->em->getRepository(BrandService::class);
        $brandService = $brandServiceRepository->find(1);

        $companyServiceRepository = $this->em->getRepository(CompanyService::class);
        $companyServices = $companyServiceRepository->findBy([
            'service' => $brandService->getId()
        ]);

        $this->assertCount(
            2,
            $companyServices
        );

        $this->entityTools->remove($brandService);

        $companyServiceRepository = $this->em->getRepository(CompanyService::class);
        $companyServices = $companyServiceRepository->findBy([
            'service' => $brandService->getId()
        ]);

        $this->assertCount(
            0,
            $companyServices
        );
    }
}