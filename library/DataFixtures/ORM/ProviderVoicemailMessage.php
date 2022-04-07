<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\VoicemailMessageStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\VoicemailMessage\VoicemailMessage;

class ProviderVoicemailMessage extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private VoicemailMessageStub $voicemailMessageStub,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(VoicemailMessage::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->voicemailMessageStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_VoicemailMessage' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderVoicemail::class,
            AstVoicemailMessage::class,
        ];
    }
}
