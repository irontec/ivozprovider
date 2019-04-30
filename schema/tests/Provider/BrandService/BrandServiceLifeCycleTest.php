<?php

namespace Tests\Provider\BrandService;

use Ivoz\Provider\Domain\Model\BrandService\BrandServiceDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;

class BrandServiceLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function createDto()
    {
        $brandService = new BrandServiceDto();
        $brandService
            ->setCode('78')
            ->setBrandId(1)
            ->setServiceId(4);

        return $brandService;
    }

    protected function addBrandService()
    {
        $brandServiceDto = $this->createDto();

        /** @var Carrier $brandService */
        $brandService = $this->entityTools
            ->persistDto($brandServiceDto, null, true);

        return $brandService;
    }

    protected function updateBrandService()
    {
        $brandServiceRepository = $this->em
            ->getRepository(BrandService::class);

        $brandService = $brandServiceRepository->find(1);

        /** @var BrandServiceDto $brandServiceDto */
        $brandServiceDto = $this->entityTools->entityToDto($brandService);

        $brandServiceDto
            ->setCode('77');

        return $this
            ->entityTools
            ->persistDto($brandServiceDto, $brandService, true);
    }

    protected function removeBrandService()
    {
        $brandServiceRepository = $this->em
            ->getRepository(BrandService::class);

        $brandService = $brandServiceRepository->find(1);

        $this
            ->entityTools
            ->remove($brandService);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addBrandService();
        $this->assetChangedEntities([
            BrandService::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateBrandService();
        $this->assetChangedEntities([
            BrandService::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeBrandService();
        $this->assetChangedEntities([
            BrandService::class,
            CompanyService::class,
        ]);
    }

    /////////////////////////////////////////
    ///
    /////////////////////////////////////////

    /**
     * @test
     * @deprecated
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
