<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\UsersLocation\UsersLocation;

class KamUsersLocation extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(UsersLocation::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var UsersLocation $item1 */
        $item1 = $this->createEntityInstance(UsersLocation::class);
        $domain = $fixture->getReference('_reference_ProviderDomain3');
        (function () use ($domain, $fixture) {
            $this->expires = new \DateTime('2030-12-31 23:59:59');
            $this->setContact('sip:yealinktest@10.10.1.106:5060');
            $this->setReceived('sip:212.64.172.23:5060');
            $this->setUserAgent('Yealink SIP-T23G 44.80.0.130');
            $this->setDomain($domain->getDomain());
            $this->setUsername('alice');
            $this->lastModified = new \DateTime('1900-01-01 00:00:00');
            $this->setRuid('uloc-5cf7df4e-2b02-ba');
        })->call($item1);

        $this->addReference('_reference_KamUsersLocation1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var UsersLocation $item2 */
        $item2 = $this->createEntityInstance(UsersLocation::class);
        $domain = $fixture->getReference('_reference_ProviderDomain3');
        (function () use ($domain, $fixture) {
            $this->expires = new \DateTime('2030-12-31 23:59:59');
            $this->setContact('sip:yealinktest@10.10.1.107:5060');
            $this->setReceived('sip:212.64.172.24:5060');
            $this->setUserAgent('Yealink SIP-T23G 44.80.0.130');
            $this->setDomain($domain->getDomain());
            $this->setUsername('testFriend');
            $this->lastModified = new \DateTime('1900-01-01 00:00:0');
            $this->setRuid('uloc-5cf7df4e-2b02-bb');
        })->call($item2);

        $this->addReference('_reference_KamUsersLocation2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /** @var UsersLocation $item3 */
        $item3 = $this->createEntityInstance(UsersLocation::class);
        $domain = $fixture->getReference('_reference_ProviderDomain6');
        (function () use ($domain, $fixture) {
            $this->expires = new \DateTime('2030-12-31 23:59:59');
            $this->setContact('sip:yealinktest@10.10.1.108:5060');
            $this->setReceived('sip:212.64.172.25:5060');
            $this->setUserAgent('Yealink SIP-T23G 44.80.0.130');
            $this->setDomain($domain->getDomain());
            $this->setUsername('residentialDevice');
            $this->lastModified = new \DateTime('1900-01-01 00:00:0');
            $this->setRuid('uloc-5cf7df4e-2b02-bc');
        })->call($item3);

        $this->addReference('_reference_KamUsersLocation3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        /** @var UsersLocation $item4 */
        $item4 = $this->createEntityInstance(UsersLocation::class);
        $domain = $fixture->getReference('_reference_ProviderDomain6');
        (function () use ($domain, $fixture) {
            $this->expires = new \DateTime('2030-12-31 23:59:59');
            $this->setContact('sip:yealinktest@10.10.1.109:5060');
            $this->setReceived('sip:212.64.172.26:5060');
            $this->setUserAgent('Yealink SIP-T23G 44.80.0.130');
            $this->setDomain($domain->getDomain());
            $this->setUsername('testRetailAccount');
            $this->lastModified = new \DateTime('1900-01-01 00:00:0');
            $this->setRuid('uloc-5cf7df4e-2b02-bd');
        })->call($item4);

        $this->addReference('_reference_KamUsersLocation4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        /** @var UsersLocation $item5 */
        $item5 = $this->createEntityInstance(UsersLocation::class);
        $domain = $fixture->getReference('_reference_ProviderDomain6');
        (function () use ($domain, $fixture) {
            $this->expires = new \DateTime('2030-12-31 23:59:59');
            $this->setContact('sip:yealinktest@10.10.1.110:5060');
            $this->setUserAgent('Yealink SIP-T23G 44.80.0.130');
            $this->setDomain($domain->getDomain());
            $this->setUsername('residentialDevice');
            $this->lastModified = new \DateTime('1900-01-01 00:00:0');
            $this->setRuid('uloc-5cf7df4e-2b12-be');
        })->call($item5);

        $this->addReference('_reference_KamUsersLocation5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderTerminal::class,
            ProviderFriend::class,
            ProviderResidentialDevice::class,
            ProviderRetailAccount::class,
        );
    }
}
