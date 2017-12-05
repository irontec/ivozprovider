<?php

namespace spec\Ivoz\Provider\Domain\Model\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturerInterface;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelDTO;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class TerminalModelSpec extends ObjectBehavior
{
    use HelperTrait;

    function let(
        TerminalManufacturerInterface $terminalManufacturer
    ) {
        $dto = new TerminalModelDTO();
        $dto->setIden('Iden')
            ->setName('Name')
            ->setDescription('Description');

        $this->hydrate(
            $dto,
            [
                'terminalManufacturer' => $terminalManufacturer->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDTO',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(TerminalModel::class);
    }

    function it_throws_exception_on_invalid_iden()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setIden', ['iden with whitespaces']);

        $this
            ->shouldThrow('\Exception')
            ->during('setIden', ['iden with $simbols']);
    }

    function it_accepts_valid_iden()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setIden', ['IdenWithoutNamespaces1']);
    }
}
