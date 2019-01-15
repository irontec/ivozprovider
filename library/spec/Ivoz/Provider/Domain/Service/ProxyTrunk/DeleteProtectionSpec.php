<?php

namespace spec\Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Service\ProxyTrunk\DeleteProtection;
use PhpSpec\ObjectBehavior;

class DeleteProtectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteProtection::class);
    }

    function it_denies_main_address_deletetion(ProxyTrunkInterface $proxyTrunk)
    {
        $proxyTrunk
            ->getId()
            ->willReturn(ProxyTrunk::MAIN_ADDRESS_ID)
            ->shouldBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($proxyTrunk);
    }
}
