<?php

namespace Tests\Ast\VoicemailMessage;

use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessage;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageInterface;
use Ivoz\Ast\Domain\Model\VoicemailMessage\VoicemailMessageRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class AstVoicemailMessageRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * Guards the test itself against the infinite loop it checks for
     */
    private const MAX_BATCHES = 10;

    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_walks_unparsed_messages_even_if_they_are_not_marked_as_parsed();
    }

    public function its_instantiable()
    {
        /** @var VoicemailMessageRepository $repository */
        $repository = $this
            ->em
            ->getRepository(VoicemailMessage::class);

        $this->assertInstanceOf(
            VoicemailMessageRepository::class,
            $repository
        );
    }

    public function it_walks_unparsed_messages_even_if_they_are_not_marked_as_parsed()
    {
        /** @var VoicemailMessageRepository $repository */
        $repository = $this
            ->em
            ->getRepository(VoicemailMessage::class);

        $generator = $repository->getUnparsedMessagesGeneratorWithoutOffset(1);

        $ids = [];
        $batches = 0;
        foreach ($generator as $voicemailMessages) {
            $batches++;
            if ($batches > self::MAX_BATCHES) {
                break;
            }

            foreach ($voicemailMessages as $voicemailMessage) {
                $this->assertInstanceOf(
                    VoicemailMessageInterface::class,
                    $voicemailMessage
                );
                $ids[] = $voicemailMessage->getId();
            }
        }

        $this->assertEquals(
            [1, 2, 3],
            $ids
        );
    }
}
