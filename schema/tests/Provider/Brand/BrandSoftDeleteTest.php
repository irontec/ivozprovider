<?php

namespace Tests\Provider\Brand;

use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrand;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrand;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class BrandSoftDeleteTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function removeBrand($brandId)
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);

        $brand = $brandRepository->find($brandId);

        $this->entityTools->remove($brand);
    }

    /**
     * @test
     */
    public function it_removes_brand()
    {
        $brandRepository = $this->em
            ->getRepository(Brand::class);

        $fixtureBrands = $brandRepository->findAll();
        $this->assertCount(3, $fixtureBrands);

        $this->removeBrand(1);

        $brands = $brandRepository->findAll();
        $this->assertCount(2, $brands);

        $this->removes_brand_webPortals();
        $this->removes_brand_musicsOnHold();
        $this->removes_brand_invoices();
        $this->removes_brand_companies();
        $this->removes_brand_application_server_sets_rel_brand();
        $this->removes_brand_media_relay_sets_rel_brand();
    }

    protected function removes_brand_webPortals()
    {
        $changelog = $this->getChangelogByClass(
            WebPortal::class
        );

        $this->assertCount(4, $changelog);

        for ($i = 0; $i < count($changelog); $i++) {
            $this->assertEquals(
                $changelog[$i]->getData(),
                null
            );
        }
    }

    protected function removes_brand_musicsOnHold()
    {
        $changelog = $this->getChangelogByClass(
            MusicOnHold::class
        );

        $this->assertCount(2, $changelog);

        for ($i = 0; $i < count($changelog); $i++) {
            $this->assertEquals(
                $changelog[$i]->getData(),
                null
            );
        }
    }

    protected function removes_brand_invoices()
    {
        $changelog = $this->getChangelogByClass(
            Invoice::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_brand_companies()
    {
        $changelog = $this->getChangelogByClass(
            Company::class
        );

        $this->assertCount(5, $changelog);

        for ($i = 0; $i < count($changelog); $i++) {
            $this->assertEquals(
                $changelog[$i]->getData(),
                null
            );
        }
    }

    protected function removes_brand_application_server_sets_rel_brand()
    {
        $changelog = $this->getChangelogByClass(
            ApplicationServerSetsRelBrand::class
        );

        $this->assertCount(2, $changelog);

        for ($i = 0; $i < count($changelog); $i++) {
            $this->assertEquals(
                $changelog[$i]->getData(),
                null
            );
        }
    }

    protected function removes_brand_media_relay_sets_rel_brand()
    {
        $changelog = $this->getChangelogByClass(
            MediaRelaySetsRelBrand::class
        );

        $this->assertCount(2, $changelog);

        for ($i = 0; $i < count($changelog); $i++) {
            $this->assertEquals(
                $changelog[$i]->getData(),
                null
            );
        }
    }
}
