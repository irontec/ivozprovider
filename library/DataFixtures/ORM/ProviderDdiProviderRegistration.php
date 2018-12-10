<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationInterface;

class ProviderDdiProviderRegistration extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(DdiProviderRegistration::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var DdiProviderRegistrationInterface $item1 */
        $item1 = $this->createEntityInstance(DdiProviderRegistration::class);
        (function () {
            $this->setUsername("DDIRegistrationUsername");
            $this->setDomain("DDIRegistrationDomain");
            $this->setRealm("DDIRegistrationRealm");
            $this->setAuthUsername("DDIRegistrationAuthUsername");
            $this->setAuthPassword("DDIRegistrationAuthPassword");
            $this->setAuthProxy("sip:DDIRegistrationAuthProxy");
            $this->setExpires(2000);
            $this->setMultiDdi(0);
            $this->setContactUsername("DDIRegistrationContactUsername");
        })->call($item1);

        $item1->setDdiProvider($this->getReference('_reference_ProviderDdiProvider1'));
        $this->addReference('_reference_ProviderDdiProviderRegistration1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderDdiProvider::class,
        );
    }
}
