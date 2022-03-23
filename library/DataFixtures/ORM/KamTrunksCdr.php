<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdr;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;

class KamTrunksCdr extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksCdr::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TrunksCdrInterface $item1 */
        $item1 = $this->createEntityInstance(TrunksCdr::class);
        (function () use ($fixture) {
            $this->setStartTime(new \DateTime('2021-11-09 05:44:14'));
            $this->setEndTime(new \DateTime('2021-11-09 05:44:23'));
            $this->setDuration(4.765);
            $this->setDirection('outbound');

            $this->setCaller('+3494696823899');
            $this->setCallee('+34676238611');
            $this->setCallid('1262640e-18d5-4641-880d-e4f411786711');
            $this->setCallidHash('2789d532');
            $this->setXcallid('9297bdde-309cd48f@10.10.1.123');
            $this->setParsed(0);
            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e01');
            $this->setParserScheduledAt(new \DateTime('2018-11-22 16:54:54'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
        })->call($item1);

        $this->addReference('_reference_KamTrunksCdr1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /////////////////////////
        ///
        ////////////////////////

        /** @var TrunksCdrInterface $item2 */
        $item2 = $this->createEntityInstance(TrunksCdr::class);
        (function () use ($fixture) {
            $this->setStartTime(new \DateTime('2021-11-22 16:54:49'));
            $this->setEndTime(new \DateTime('2021-11-22 16:54:54'));
            $this->setDuration(4.765);
            $this->setDirection('outbound');

            $this->setCaller('+3494696823899');
            $this->setCallee('+34676238611');
            $this->setCallid('017cc7c8-eb38-4bbd-9318-524a274f7002');
            $this->setCallidHash('2789d532');
            $this->setXcallid('9297bdde-309cd48f@10.10.1.123');
            $this->setParsed(1);
            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e02');
            $this->setParserScheduledAt(new \DateTime('2018-11-22 16:54:54'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
        })->call($item2);

        $this->addReference('_reference_KamTrunksCdr2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        /////////////////////////
        ///
        ////////////////////////

        /** @var TrunksCdrInterface $item3 */
        $item3 = $this->createEntityInstance(TrunksCdr::class);
        (function () use ($fixture) {
            $this->setStartTime(new \DateTime('2021-11-22 17:55:49'));
            $this->setEndTime(new \DateTime('2021-11-22 17:55:54'));
            $this->setDuration(54.765);
            $this->setDirection('outbound');

            $this->setCaller('+3494696823899');
            $this->setCallee('+34676238611');
            $this->setCallid('017cc7c8-eb38-4bbd-9318-524a274f7003');
            $this->setCallidHash('2789d572');
            $this->setXcallid('9297bdde-309cd49f@10.10.1.123');
            $this->setParsed(1);
            $this->setCgrid('5a364b1fe35e00fb2ac1923b43f84eeb78400e03');
            $this->setParserScheduledAt(new \DateTime('2018-11-22 16:54:54'));
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
        })->call($item3);

        $this->addReference('_reference_KamTrunksCdr3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderCarrier::class,
        );
    }
}
