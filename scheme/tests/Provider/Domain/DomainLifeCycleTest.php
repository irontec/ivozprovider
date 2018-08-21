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
            ->setDescription('127.7.7.7');

        /** @var Domain $domain */
        $domain = $this->entityTools
            ->persistDto($domainDto, null, true);

        return $domain;
    }

    /**
     * @test
     */
    public function it_persists_domains()
    {
        $domainRepository = $this->em
            ->getRepository(Domain::class);

        $fixtureDomains = $domainRepository->findAll();
        $this->assertCount(6, $fixtureDomains);

        $this->addDomain();

        $companies = $domainRepository->findAll();
        $this->assertCount(7, $companies);
    }

    /**
     * @test
     */
    public function updating_domain_updates_friend_endpoints()
    {
        $domainRepository =  $this->em
            ->getRepository(Domain::class);
        /** @var Domain $domain */
        $domain = $domainRepository->find(3);
        $domain->setDomain('api-test.ivozprovider.local');
        $domain->replaceResidentialDevices(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );
        $domain->replaceTerminals(
            new \Doctrine\Common\Collections\ArrayCollection([])
        );

        $this->entityTools->persist($domain, true);

        $friends = $domain->getFriends();
        $this->assertCount(
            1,
            $friends
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
     */
    public function updating_domain_updates_residentialDevices_endpoints()
    {
        $domainRepository =  $this->em
            ->getRepository(Domain::class);
        /** @var Domain $domain */
        $domain = $domainRepository->find(6);
        $domain->setDomain('api-test.ivozprovider.local');
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
     */
    public function updating_domain_updates_terminal_endpoints()
    {
        $domainRepository =  $this->em
            ->getRepository(Domain::class);
        /** @var Domain $domain */
        $domain = $domainRepository->find(3);
        $domain->setDomain('api-test.ivozprovider.local');
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