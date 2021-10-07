<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CompanyService\CompanyService;

class ProviderCompanyService extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CompanyService::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("94");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setService($fixture->getReference('_reference_ProviderService1'));
        })->call($item1);

        $this->addReference('_reference_ProviderCompanyService1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("95");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setService($fixture->getReference('_reference_ProviderService2'));
        })->call($item2);

        $this->addReference('_reference_ProviderCompanyService2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("93");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setService($fixture->getReference('_reference_ProviderService3'));
        })->call($item3);

        $this->addReference('_reference_ProviderCompanyService3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("94");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
            $this->setService($fixture->getReference('_reference_ProviderService1'));
        })->call($item4);

        $this->addReference('_reference_ProviderCompanyService5', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("95");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
            $this->setService($fixture->getReference('_reference_ProviderService2'));
        })->call($item5);

        $this->addReference('_reference_ProviderCompanyService6', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstance(CompanyService::class);
        (function () use ($fixture) {
            $this->setCode("93");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
            $this->setService($fixture->getReference('_reference_ProviderService3'));
        })->call($item6);

        $this->addReference('_reference_ProviderCompanyService7', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderService::class
        );
    }
}
