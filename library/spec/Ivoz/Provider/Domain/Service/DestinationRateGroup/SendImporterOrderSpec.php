<?php

namespace spec\Ivoz\Provider\Domain\Service\DestinationRateGroup;

use Ivoz\Provider\Domain\Service\DestinationRateGroup\SendImporterOrder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Provider\Infrastructure\Gearman\Jobs\RatesImporter;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupInterface;
use spec\HelperTrait;

class SendImporterOrderSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var RatesImporter
     */
    protected $importer;

    /**
     * SendImporterOrder constructor.
     *
     * @param RatesImporter $importer
     */
    public function let(
        RatesImporter $importer
    ) {
        $this->importer = $importer;

        $this->beConstructedWith(
            $this->importer
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SendImporterOrder::class);
    }


    function it_sends_import_job(
        DestinationRateGroupInterface $entity
    ) {

        $this->getterProphecy(
            $entity,
            [
                'getStatus' => 'waiting',
                'hasChanged' => function () {
                    return [['status'], true];
                },
                'hasBeenDeleted' => false,
                'getId' => 1
            ],
            true
        );

        $this->importer
            ->setParams(Argument::any())
            ->willReturn($this->importer)
            ->shouldBeCalled();

        $this->importer
            ->send()
            ->shouldBeCalled();

        $this->execute($entity);
    }
}
