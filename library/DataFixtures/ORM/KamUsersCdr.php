<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdr;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface;

class KamUsersCdr extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(UsersCdr::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var UsersCdrInterface $item1 */
        $item1 = $this->createEntityInstance(UsersCdr::class);
        (function () {
            $this->setStartTime(new \DateTime('2018-11-22 16:54:49'));
            $this->setEndTime(new \DateTime('2018-11-22 16:54:54'));
            $this->setDuration(4.539);
            $this->setDirection('outbound');
            $this->setCaller('102');
            $this->setCallee('+34676896561');
            $this->setCallid('9297bdde-309cd48f@10.10.1.123');
            $this->setCallidHash('517fa1eb');
        })->call($item1);

        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setUser($this->getReference('_reference_ProviderUser1'));

        $this->addReference('_reference_KamUsersCdr1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderUser::class,
        );
    }
}
