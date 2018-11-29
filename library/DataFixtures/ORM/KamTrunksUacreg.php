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
        $item1 = $this->createEntityInstance(TrunksUacreg::class);
        (function () {
            $this->setLUuid("DDIRegistrationContactUsername");
            $this->setRUsername("DDIRegistrationUsername");
            $this->setRDomain("DDIRegistrationDomain");
            $this->setAuthUsername("DDIRegistrationAuthUsername");
            $this->setAuthPassword("DDIRegistrationAuthPassword");
            $this->setAuthProxy("sip:DDIRegistrationAuthProxy");
            $this->setExpires(2000);
            $this->setFlags(0);
            $this->setRegDelay(0);
        })->call($item1);

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
