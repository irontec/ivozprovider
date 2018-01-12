<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\Name;
use Ivoz\Provider\Domain\Model\Service\Description;

class ProviderService extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Service::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Service::class);
        $item1->setIden("DirectPickUp");
        $item1->setDefaultCode("94");
        $item1->setExtraArgs(true);
        $item1->setName(new Name('en', 'en'));
        $item1->setDescription(new Description('en', 'en'));
        $this->addReference('_reference_IvozProviderDomainModelServiceService1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Service::class);
        $item2->setIden("GroupPickUp");
        $item2->setDefaultCode("95");
        $item2->setExtraArgs(false);
        $item2->setName(new Name('en', 'en'));
        $item2->setDescription(new Description('en', 'en'));
        $this->addReference('_reference_IvozProviderDomainModelServiceService2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Service::class);
        $item3->setIden("Voicemail");
        $item3->setDefaultCode("93");
        $item3->setExtraArgs(true);
        $item3->setName(new Name('en', 'en'));
        $item3->setDescription(new Description('en', 'en'));
        $this->addReference('_reference_IvozProviderDomainModelServiceService3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(Service::class);
        $item4->setIden("RecordLocution");
        $item4->setDefaultCode("00");
        $item4->setExtraArgs(true);
        $item4->setName(new Name('en', 'en'));
        $item4->setDescription(new Description('en', 'en'));
        $this->addReference('_reference_IvozProviderDomainModelServiceService4', $item4);
        $manager->persist($item4);

    
        $manager->flush();
    }

}
