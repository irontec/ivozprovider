<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Ast\VoicemailStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;

class AstVoicemail extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    private $voicemailStub;

    public function __construct(
        VoicemailStub $voicemailStub
    ) {
        $this->voicemailStub = $voicemailStub;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Voicemail::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->voicemailStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_AstVoicemail' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderVoicemail::class,
        );
    }
}
