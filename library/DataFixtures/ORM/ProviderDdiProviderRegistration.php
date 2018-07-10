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
        $item1 = $this->createEntityInstanceWithPublicMethods(DdiProviderRegistration::class);
        $item1->setUsername("DDIRegistrationUsername");
        $item1->setDomain("DDIRegistrationDomain");
        $item1->setRealm("DDIRegistrationRealm");
        $item1->setAuthUsername("DDIRegistrationAuthUsername");
        $item1->setAuthPassword("DDIRegistrationAuthPassword");
        $item1->setAuthProxy("sip:DDIRegistrationAuthProxy");
        $item1->setExpires(2000);
        $item1->setMultiDdi(0);
        $item1->setContactUsername("DDIRegistrationContactUsername");
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
