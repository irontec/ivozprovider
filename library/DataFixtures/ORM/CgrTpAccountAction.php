<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Cgr\Domain\Model\TpAccountAction\TpAccountAction;

class CgrTpAccountAction extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(TpAccountAction::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TpAccountAction $item1 */
        $item1 = $this->createEntityInstance(TpAccountAction::class);
        (function () {
            $this->setTpid('ivozprovider');
            $this->setLoadid('DATABASE');
            $this->setTenant('b1');
            $this->setAccount('c1');
            $this->setActionPlanTag(null);
            $this->setActionTriggersTag(null);
            $this->setAllowNegative(false);
            $this->setDisabled(false);
            $this->setCreatedAt(new \DateTime('2018-01-01 10:10:10'));
        })->call($item1);
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $this->addReference('_reference_CgrTpAccountAction1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TpAccountAction::class);
        (function () {
            $this->setTpid('ivozprovider');
            $this->setLoadid('DATABASE');
            $this->setTenant('b1');
            $this->setAccount('c2');
            $this->setActionPlanTag(null);
            $this->setActionTriggersTag(null);
            $this->setAllowNegative(false);
            $this->setDisabled(false);
            $this->setCreatedAt(new \DateTime('2017-02-01 10:11:12'));
        })->call($item2);

        $item2->setCompany(
            $this->getReference('_reference_ProviderCompany2')
        );
        $this->addReference('_reference_CgrTpAccountAction2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
        );
    }
}
