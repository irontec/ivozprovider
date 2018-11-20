<?php

namespace spec\Ivoz\Provider\Domain\Service\Friend;

use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Friend\CheckUniqueness;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use spec\HelperTrait;
use Zend\EventManager\Exception\DomainException;

class CheckUniquenessSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var TerminalRepository
     */
    protected $terminalRepository;

    public function let(
        TerminalRepository $terminalRepository
    ) {
        $this->terminalRepository = $terminalRepository;

        $this->beConstructedWith(
            $this->terminalRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CheckUniqueness::class);
    }

    function it_throws_exception_on_duplicated_name(
        FriendInterface $friend,
        DomainInterface $domain,
        TerminalInterface $terminal
    ) {

        $this->getterProphecy(
            $friend,
            [
                'getName' => 'name',
                'getDomain' => $domain
            ],
            true
        );

        $this
            ->terminalRepository
            ->findOneByNameAndDomain(
                Argument::type('string'),
                Argument::type(DomainInterface::class)
            )
            ->willReturn($terminal)
            ->shouldBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->during('execute', [$friend, true]);
    }
}
