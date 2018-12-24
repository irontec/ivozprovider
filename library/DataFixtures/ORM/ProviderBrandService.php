<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BrandService::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(BrandService::class);
        (function () {
            $this->setCode("94");
        })->call($item1);

        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setService($this->getReference('_reference_ProviderService1'));
        $this->addReference('_reference_ProviderBrandService1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(BrandService::class);
        (function () {
            $this->setCode("95");
        })->call($item2);

        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setService($this->getReference('_reference_ProviderService2'));
        $this->addReference('_reference_ProviderBrandService2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(BrandService::class);
        (function () {
            $this->setCode("93");
        })->call($item3);

        $item3->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item3->setService($this->getReference('_reference_ProviderService3'));
        $this->addReference('_reference_ProviderBrandService3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

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
