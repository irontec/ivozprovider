<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\Logo;

class ProviderWebPortal extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(WebPortal::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(WebPortal::class);
        (function () use ($fixture) {
            $this->setUrl("https://platform-ivozprovider.irontec.com");
            $this->setKlearTheme("redmond");
            $this->setUrlType("god");
            $this->setName("Platform Administration Portal");
            $this->setUserTheme("default");
            $this->logo = new Logo(10, 'image/jpeg', 'logo.jpeg');
        })->call($item1);

        $this->addReference('_reference_ProviderWebPortal1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(WebPortal::class);
        (function () use ($fixture) {
            $this->setUrl("https://brand-ivozprovider.irontec.com");
            $this->setKlearTheme("irontec-red");
            $this->setUrlType("brand");
            $this->setName("Irontec Ivozprovider Brand Admin Portal");
            $this->setUserTheme("default");
            $this->logo = new Logo(10, 'image/jpeg', 'brand-logo.jpeg');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item2);

        $this->addReference('_reference_ProviderWebPortal2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);


        $item3 = $this->createEntityInstance(WebPortal::class);
        (function () use ($fixture) {
            $this->setUrl("https://client-ivozprovider.irontec.com");
            $this->setKlearTheme("irontec-red");
            $this->setUrlType("admin");
            $this->setName("Irontec Ivozprovider Client Admin Portal");
            $this->setUserTheme("default");
            $this->logo = new Logo(10, 'image/jpeg', 'client-logo.jpeg');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item3);

        $this->addReference('_reference_ProviderWebPortal3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(WebPortal::class);
        (function () use ($fixture) {
            $this->setUrl("https://users-ivozprovider.irontec.com");
            $this->setKlearTheme("redmond");
            $this->setUrlType("user");
            $this->setName("Irontec Ivozprovider User Admin Portal");
            $this->setUserTheme("default");
            $this->logo = new Logo(10, 'image/jpeg', 'user-logo.jpeg');
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item4);

        $this->addReference('_reference_ProviderWebPortal4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
