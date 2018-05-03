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
        $item1 = $this->createEntityInstanceWithPublicMethods(TpAccountAction::class);

        $item1->setTpid('ivozprovider');
        $item1->setLoadid('DATABASE');
        $item1->setTenant('b1');
        $item1->setAccount('c1');
        $item1->setActionPlanTag(null);
        $item1->setActionTriggersTag(null);
        $item1->setAllowNegative(false);
        $item1->setDisabled(false);
        $item1->setCreatedAt(new \DateTime('2018-01-01 10:10:10'));
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $this->addReference('_reference_CgrTpAccountAction1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(TpAccountAction::class);
        $item2->setTpid('ivozprovider');
        $item2->setLoadid('DATABASE');
        $item2->setTenant('b1');
        $item2->setAccount('c2');
        $item2->setActionPlanTag(null);
        $item2->setActionTriggersTag(null);
        $item2->setAllowNegative(false);
        $item2->setDisabled(false);
        $item2->setCreatedAt(new \DateTime('2017-02-01 10:11:12'));
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
