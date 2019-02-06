<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BillableCall\BillableCall;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\Logo;
use Ivoz\Provider\Domain\Model\Brand\Invoice;

class ProviderBillableCalls extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Brand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        for ($i = 0; $i < 100; $i++) {
            $item = $this->createEntityInstance(BillableCall::class);
            (function () use ($i) {
                $this->setCallid(
                    '017cc7c8-eb38-4bbd-9318-524a274f7' . str_pad($i, 3, '0', STR_PAD_LEFT)
                );
                $this->setStartTime(new \DateTime('2019-01-01 08:00:00'));
                $this->setCaller('+34633646464');
                $this->setCallee('+34633656565');
            })->call($item);

            $item->setBrand($this->getReference('_reference_ProviderBrand1'));
            $item->setCompany($this->getReference('_reference_ProviderCompany1'));

            $this->addReference('_reference_ProviderBillableCall' . $i, $item);
            $manager->persist($item);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
