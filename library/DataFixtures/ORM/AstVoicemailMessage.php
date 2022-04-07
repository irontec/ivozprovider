<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Ast\VoicemailMessageStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessage;

class AstVoicemailMessage extends Fixture implements DependentFixtureInterface
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
                '_reference_AstVoicemailMessage' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            AstVoicemail::class,
        ];
    }
}
