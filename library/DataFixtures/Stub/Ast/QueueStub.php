<?php

namespace DataFixtures\Stub\Ast;

use DataFixtures\Stub\StubTrait;
use Ivoz\Ast\Domain\Model\Queue\Queue;
use Ivoz\Ast\Domain\Model\Queue\QueueDto;

class QueueStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Queue::class;
    }

    protected function load()
    {
        $dto = (new QueueDto(1))
            ->setName('ast_queue_1')
            ->setPeriodicAnnounce(
                '/opt/irontec/ivozprovider/storage/ivozprovider_model_locutions.encodedfile/0/1.'
            )
            ->setPeriodicAnnounceFrequency(7)
            ->setTimeout(1)
            ->setWrapuptime(0)
            ->setMaxlen(5)
            ->setStrategy('rrmemory')
            ->setWeight(5)
            ->setAutopause('no')
            ->setRinginuse('no')
            ->setQueueId(
                1
            );
        $this->append($dto);
    }
}
