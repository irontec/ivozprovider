<?php

namespace Tests\Provider\Domain;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class DomainLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return Domain
     */
    protected function addDomain()
    {
        $domainDto = new DomainDto();
        $domainDto
            ->setDomain('api.ivozprovider.local')
            ->setDescription('desc');

        /** @var Domain $domain */
        $domain = $this->entityTools
            ->persistDto($domainDto, null, true);

        return $domain;
    }

    protected function updateDomain()
    {
        $domainRepository = $this->em
            ->getRepository(Domain::class);

        $domain = $domainRepository->find(3);

        /** @var DomainDto $domainDto */
        $domainDto = $this->entityTools->entityToDto($domain);

        $domainDto
            ->setDomain('update-domain.net');

        return $this
            ->entityTools
            ->persistDto($domainDto, $domain, true);
    }

    protected function removeDomain()
    {
        $domainRepository = $this->em
            ->getRepository(Domain::class);

        $domain = $domainRepository->find(1);

        $this
            ->entityTools
            ->remove($domain);
    }

    /**
     * @test
     */
    public function it_persists_domains()
    {
        $domainRepository = $this->em
            ->getRepository(Domain::class);
        $fixtureDomains = $domainRepository->findAll();

        $this->addDomain();

        $companies = $domainRepository->findAll();
        $this->assertCount(count($fixtureDomains) + 1, $companies);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addDomain();
        $this->assetChangedEntities([
            Domain::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDomain();
        $this->assetChangedEntities([
            Domain::class,
            PsEndpoint::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDomain();
        $this->assetChangedEntities([
            Domain::class
        ]);
    }

    ///////////////////////////////////////////////////
    ///
    ///////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function updating_domain_updates_residentialDevices_endpoints()
    {
        $domainRepository =  $this->em
            ->getRepository(Domain::class);
        /** @var Domain $domain */
        $domain = $domainRepository->find(6);
        (function () {
            $this->setDomain('api-test.ivozprovider.local');
        })->call($domain);

        $domain->replaceFriends(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );
        $domain->replaceTerminals(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );

        $this->entityTools->persist($domain, true);

        $residentialDevices = $domain->getResidentialDevices();
        $this->assertCount(
            1,
            $residentialDevices
        );

        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(
            1,
            $changelogEntries
        );

        foreach ($changelogEntries as $changelogEntry) {
            $this->assertEquals(
                $changelogEntry->getData(),
                [
                    'from_domain' => 'api-test.ivozprovider.local'
                ]
            );
        }
    }

    /**
     * @test
     * @deprecated
     */
    public function updating_domain_updates_terminal_endpoints()
    {
        $domainRepository =  $this->em
            ->getRepository(Domain::class);
        /** @var Domain $domain */
        $domain = $domainRepository->find(3);

        (function () {
            $this->setDomain('api-test.ivozprovider.local');
        })->call($domain);

        $domain->replaceFriends(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );
        $domain->replaceResidentialDevices(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );

        $this->entityTools->persist($domain, true);

        $terminals = $domain->getTerminals();
        $this->assertCount(
            3,
            $terminals
        );

        $changelogEntries = $this->getChangelogByClass(
            PsEndpoint::class
        );

        $this->assertCount(
            3,
            $changelogEntries
        );

        foreach ($changelogEntries as $changelogEntry) {
            $this->assertEquals(
                $changelogEntry->getData(),
                [
                    'from_domain' => 'api-test.ivozprovider.local'
                ]
            );
        }
    }
}