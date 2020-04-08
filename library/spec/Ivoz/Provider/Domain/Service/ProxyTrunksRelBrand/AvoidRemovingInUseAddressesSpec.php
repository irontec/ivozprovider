<?php

namespace spec\Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrandInterface;
use Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand\AvoidRemovingInUseAddresses;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class AvoidRemovingInUseAddressesSpec extends ObjectBehavior
{
    use HelperTrait;

    /** @var  CarrierRepository */
    protected $carrierRepository;

    /** @var  DdiProviderRepository */
    protected $ddiProviderRepository;

    /** @var  ProxyTrunksRelBrandInterface */
    protected $entity;

    public function let()
    {
        $this->carrierRepository = $this->getTestDouble(
            CarrierRepository::class
        );

        $this->ddiProviderRepository = $this->getTestDouble(
            DdiProviderRepository::class
        );


        $brand = $this->getInstance(
            Brand::class,
            [
                'id' => 1
            ]
        );

        $proxyTrunk = $this->getInstance(
            ProxyTrunk::class,
            [
                'id' => 2
            ]
        );

        $this->entity = $this->getInstance(
            ProxyTrunksRelBrand::class,
            [
                'brand' => $brand,
                'proxyTrunk' => $proxyTrunk
            ]
        );

        $this->beConstructedWith(
            $this->carrierRepository,
            $this->ddiProviderRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AvoidRemovingInUseAddresses::class);
    }

    private function prepareExecution(
        $carrierResponse = [],
        $ddiProviders = []
    ) {
        $this
            ->carrierRepository
            ->findByBrandAndProxyTrunks(
                Argument::type(Brand::class),
                Argument::type(ProxyTrunk::class)
            )
            ->willReturn($carrierResponse)
            ->shouldBeCalled();

        $this
            ->ddiProviderRepository
            ->findByBrandAndProxyTrunks(
                Argument::type(Brand::class),
                Argument::type(ProxyTrunk::class)
            )
            ->willReturn($ddiProviders)
            ->shouldBeCalled();
    }

    function it_allows_deletion_if_none_is_using_it()
    {
        $this->prepareExecution();

        $this->execute(
            $this->entity
        );
    }

    function it_denys_deletion_if_a_carrier_is_using_it()
    {
        $carrier = $this->getInstance(
            Carrier::class
        );

        $this->prepareExecution(
            [$carrier],
            []
        );

        $this
            ->shouldThrow(\DomainException::class)
            ->during('execute', [$this->entity]);
    }

    function it_denys_deletion_if_a_ddiProvider_is_using_it()
    {
        $ddiProvider = $this->getInstance(
            DdiProvider::class
        );

        $this->prepareExecution(
            [],
            [$ddiProvider]
        );

        $this
            ->shouldThrow(\DomainException::class)
            ->during('execute', [$this->entity]);
    }
}
