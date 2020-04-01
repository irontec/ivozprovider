<?php

namespace spec\Ivoz\Provider\Domain\Service\ProxyTrunk;

use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunkInterface;
use Ivoz\Provider\Domain\Service\ProxyTrunk\DeleteProtection;
use PhpSpec\ObjectBehavior;

class DeleteProtectionSpec extends ObjectBehavior
{
    protected $carrierRepository;
    protected $ddiProviderRepository;

    function let(
        CarrierRepository $carrierRepository,
        DdiProviderRepository $ddiProviderRepository
    ) {
        $this->carrierRepository = $carrierRepository;
        $this->ddiProviderRepository = $ddiProviderRepository;

        $this->beConstructedWith(
            $carrierRepository,
            $ddiProviderRepository
        );
    }


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

    function it_denies_deletetion_if_any_carrier_uses_it(
        ProxyTrunkInterface $proxyTrunk,
        CarrierInterface $carrier
    ) {
        $this
            ->carrierRepository
            ->findByProxyTrunks($proxyTrunk)
            ->willReturn([$carrier]);

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($proxyTrunk);
    }

    function it_denies_deletetion_if_any_ddi_provider_uses_it(
        ProxyTrunkInterface $proxyTrunk,
        DdiProviderInterface $ddiProvider
    ) {
        $this
            ->ddiProviderRepository
            ->findByProxyTrunks($proxyTrunk)
            ->willReturn([$ddiProvider]);

        $this
            ->shouldThrow(\DomainException::class)
            ->duringExecute($proxyTrunk);
    }
}
