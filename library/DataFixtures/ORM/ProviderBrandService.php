<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BrandService\BrandService;

class ProviderBrandService extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BrandService::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(BrandService::class);
        (function () use ($fixture) {
            $this->setCode("94");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setService($fixture->getReference('_reference_ProviderService1'));
        })->call($item1);

        $this->addReference('_reference_ProviderBrandService1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(BrandService::class);
        (function () use ($fixture) {
            $this->setCode("95");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setService($fixture->getReference('_reference_ProviderService2'));
        })->call($item2);

        $this->addReference('_reference_ProviderBrandService2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(BrandService::class);
        (function () use ($fixture) {
            $this->setCode("93");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setService($fixture->getReference('_reference_ProviderService3'));
        })->call($item3);

        $this->addReference('_reference_ProviderBrandService3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(BrandService::class);
        (function () use ($fixture) {
            $this->setCode("93");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setService($fixture->getReference('_reference_ProviderService5'));
        })->call($item4);

        $this->addReference('_reference_ProviderBrandService4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderService::class
        );
    }
}
