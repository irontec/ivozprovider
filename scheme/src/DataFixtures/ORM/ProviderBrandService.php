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
        $manager->getClassMetadata(BrandService::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(BrandService::class);
        $item1->setCode("94");
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item1->setService($this->getReference('_reference_IvozProviderDomainModelServiceService1'));
        $this->addReference('_reference_IvozProviderDomainModelBrandServiceBrandService1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(BrandService::class);
        $item2->setCode("95");
        $item2->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item2->setService($this->getReference('_reference_IvozProviderDomainModelServiceService2'));
        $this->addReference('_reference_IvozProviderDomainModelBrandServiceBrandService2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(BrandService::class);
        $item3->setCode("93");
        $item3->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item3->setService($this->getReference('_reference_IvozProviderDomainModelServiceService3'));
        $this->addReference('_reference_IvozProviderDomainModelBrandServiceBrandService3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(BrandService::class);
        $item4->setCode("00");
        $item4->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item4->setService($this->getReference('_reference_IvozProviderDomainModelServiceService4'));
        $this->addReference('_reference_IvozProviderDomainModelBrandServiceBrandService4', $item4);
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
