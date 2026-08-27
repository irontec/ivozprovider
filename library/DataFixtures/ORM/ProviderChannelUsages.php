<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\ChannelUsage\ChannelUsage;

class ProviderChannelUsages extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);

        $company1Buckets = [
            ['2026-01-02 08:00:00', 3, 1.5, 2, 0, 0],
            ['2026-01-02 08:05:00', 5, 2.25, 4, 0, 0],
            ['2026-01-02 08:10:00', 4, 3.5, 3, 2, 1],
            ['2026-01-02 08:15:00', 2, 0.75, 1, 0, 0],
        ];

        foreach ($company1Buckets as $key => $bucket) {
            $item = $this->createEntityInstance(ChannelUsage::class);
            (function () use ($bucket, $fixture) {
                [$timestamp, $peak, $avgUsage, $closingUsage, $blockedByCompanyLimit, $blockedByBrandLimit] = $bucket;

                $this->setTimestamp(
                    new \DateTime($timestamp, new \DateTimeZone('UTC'))
                );
                $this->setPeak($peak);
                $this->setAvgUsage($avgUsage);
                $this->setClosingUsage($closingUsage);
                $this->setMaxCallsCompany(10);
                $this->setMaxCallsBrand(50);
                $this->setBlockedByCompanyLimit($blockedByCompanyLimit);
                $this->setBlockedByBrandLimit($blockedByBrandLimit);
                $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
                $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            })->call($item);

            $this->addReference('_reference_ProviderChannelUsage' . ($key + 1), $item);
            $manager->persist($item);
        }

        $item = $this->createEntityInstance(ChannelUsage::class);
        (function () use ($fixture) {
            $this->setTimestamp(
                new \DateTime('2026-01-02 08:00:00', new \DateTimeZone('UTC'))
            );
            $this->setPeak(1);
            $this->setAvgUsage(0.5);
            $this->setClosingUsage(1);
            $this->setMaxCallsCompany(5);
            $this->setMaxCallsBrand(50);
            $this->setBlockedByCompanyLimit(0);
            $this->setBlockedByBrandLimit(0);
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany3'));
        })->call($item);

        $this->addReference('_reference_ProviderChannelUsage5', $item);
        $manager->persist($item);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
        );
    }
}
