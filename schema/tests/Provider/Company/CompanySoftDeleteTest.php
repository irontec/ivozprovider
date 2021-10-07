<?php

namespace Tests\Provider\Company;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHold;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Recording\Recording;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;

class CompanySoftDeleteTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function removeCompany($companyId)
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);

        $company = $companyRepository->find($companyId);

        $this->entityTools->remove($company);
    }

    /**
     * @test
     */
    public function it_removes_companies()
    {
        $companyRepository = $this->em
            ->getRepository(Company::class);

        $fixtureCompanies = $companyRepository->findAll();
        $count = 5;
        $this->assertCount($count, $fixtureCompanies);

        $this->removeCompany(1);

        $companies = $companyRepository->findAll();
        $this->assertCount($count - 1, $companies);

        /////////////////////////////
        ///
        /////////////////////////////

        $this->removes_company_locutions();
        $this->removes_company_music_on_hold();
        $this->removes_company_recording();
        $this->removes_company_fax();
        $this->removes_company_tp_account_acCompanySoftDeleteTesttion();
        $this->removes_company_tp_rating_profile();
    }

    protected function removes_company_locutions()
    {
        $changelog = $this->getChangelogByClass(
            Locution::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_company_music_on_hold()
    {
        $changelog = $this->getChangelogByClass(
            MusicOnHold::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_company_recording()
    {
        $changelog = $this->getChangelogByClass(
            Recording::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_company_fax()
    {
        $changelog = $this->getChangelogByClass(
            Fax::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_company_tp_account_acCompanySoftDeleteTesttion()
    {
        $changelog = $this->getChangelogByClass(
            TpAccountAction::class
        );

        $this->assertCount(1, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );
    }

    protected function removes_company_tp_rating_profile()
    {
        $changelog = $this->getChangelogByClass(
            TpRatingProfile::class
        );

        $this->assertCount(2, $changelog);

        $this->assertEquals(
            $changelog[0]->getData(),
            null
        );

        $this->assertEquals(
            $changelog[1]->getData(),
            null
        );
    }
}
