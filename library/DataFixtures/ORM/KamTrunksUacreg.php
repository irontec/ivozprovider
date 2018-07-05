<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacregInterface;

class KamTrunksUacreg extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksUacreg::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TrunksUacregInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(TrunksUacreg::class);
        $item1->setLUuid("DDIRegistrationContactUsername");
        $item1->setRUsername("DDIRegistrationUsername");
        $item1->setRDomain("DDIRegistrationDomain");
        $item1->setAuthUsername("DDIRegistrationAuthUsername");
        $item1->setAuthPassword("DDIRegistrationAuthPassword");
        $item1->setAuthProxy("sip:DDIRegistrationAuthProxy");
        $item1->setExpires(2000);
        $item1->setFlags(0);
        $item1->setRegDelay(0);
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setDdiProviderRegistration($this->getReference('_reference_ProviderDdiProviderRegistration1'));
        $this->addReference('_reference_KamTrunksUacreg1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderDdiProviderRegistration::class
        );
    }
}
