<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\Brand\Brand;

class ProviderBillableCalls extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Brand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        for ($i = 0; $i < 100; $i++) {
            $item = $this->createEntityInstance(BillableCall::class);
            (function () use ($i, $fixture) {
                $this->setCallid(
                    '017cc7c8-eb38-4bbd-9318-524a274f7' . str_pad($i, 3, '0', STR_PAD_LEFT)
                );

                $startTime = new \DateTime(
                    '2019-01-01 08:00:00',
                    new \DateTimeZone('UTC')
                );
                $startTime->modify("+$i second");

                $this->setStartTime($startTime);
                $this->setCaller('+34633646464');
                $this->setCallee('+34633656565');
                $this->setDirection('outbound');
                $this->setPrice(1);
                $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
                $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
                $this->setCarrier($fixture->getReference('_reference_ProviderCarrier1'));
                $this->setDdi($fixture->getReference('_reference_ProviderDdi1'));

                if ($i === 0) {
                    $this->setTrunksCdr($fixture->getReference('_reference_KamTrunksCdr1'));
                    $this->setCarrier($fixture->getReference('_reference_ProviderCarrier2'));
                    $this->setInvoice($fixture->getReference('_reference_ProviderInvoice1'));
                }

                if ($i < 2) {
                    $this->setDdiProvider($fixture->getReference('_reference_ProviderDdiProvider1'));
                }
            })->call($item);

            $this->addReference('_reference_ProviderBillableCall' . $i, $item);
            $manager->persist($item);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderCarrier::class,
            KamTrunksCdr::class,
            ProviderInvoice::class,
            ProviderDdi::class,
        );
    }
}
