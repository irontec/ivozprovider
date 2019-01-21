<?php

namespace spec\Ivoz\Provider\Domain\Service\ProxyUser;

use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUserInterface;
use Ivoz\Provider\Domain\Service\ProxyUser\DeleteProtection;
use PhpSpec\ObjectBehavior;

class DeleteProtectionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DeleteProtection::class);
    }

    function it_denies_main_address_deletetion(ProxyUserInterface $proxyUser)
    {
        $proxyUser
            ->getId()
            ->willReturn(ProxyUser::MAIN_ADDRESS_ID)
            ->shouldBeCalled();

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($proxyUser);
    }
}
