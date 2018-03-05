<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrl;
use Ivoz\Provider\Domain\Model\BrandUrl\Logo;

class ProviderBrandUrl extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BrandUrl::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(BrandUrl::class);
        $item1->setUrl("https://example.com");
        $item1->setKlearTheme("redmond");
        $item1->setUrlType("god");
        $item1->setName("Platform Administration Portal");
        $item1->setUserTheme("default");
        $item1->setLogo(new Logo(null, null, null));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderBrandUrl1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(BrandUrl::class);
        $item2->setUrl("https://test-ivozprovider.irontec.com");
        $item2->setKlearTheme("irontec-red");
        $item2->setUrlType("god");
        $item2->setName("Irontec Ivozprovider God Portal");
        $item2->setUserTheme("default");
        $item2->setLogo(new Logo(null, null, null));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderBrandUrl2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(BrandUrl::class);
        $item3->setUrl("https://users.artemis.irontec.com");
        $item3->setKlearTheme("redmond");
        $item3->setUrlType("user");
        $item3->setName("Users");
        $item3->setUserTheme("default");
        $item3->setLogo(new Logo(null, null, null));
        $item3->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderBrandUrl3', $item3);
        $manager->persist($item3);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
