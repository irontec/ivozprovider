<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Ast\PsEndpointStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;

class AstPsEndpoint extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    private $psEndpointStub;

    public function __construct(
        PsEndpointStub $psEndpointStub
    ) {
        $this->psEndpointStub = $psEndpointStub;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager
            ->getClassMetadata(PsEndpoint::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->psEndpointStub->getAll();

        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_AstPsEndpoint' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFriend::class,
            ProviderResidentialDevice::class
        );
    }
}
