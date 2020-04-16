<?php

namespace spec\Ivoz\Provider\Domain\Service\ProxyTrunksRelBrand;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\Carrier\CarrierRepository;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;
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

    /** @var  EntityTools */
    protected $entityTools;

    /** @var  CarrierRepository */
    protected $carrierRepository;

    /** @var  DdiProviderRepository */
    protected $ddiProviderRepository;

    /** @var  ProxyTrunksRelBrandInterface */
    protected $entity;

    public function let()
    {
        $this->entityTools = $this->getTestDouble(
            EntityTools::class
        );

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
            $this->entityTools,
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
            ->entityTools
            ->isScheduledForRemoval(
                Argument::type(Brand::class)
            )
            ->willReturn(false);

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

    function it_return_if_brand_is_being_removed()
    {
        $this
            ->entityTools
            ->isScheduledForRemoval(
                Argument::any()
            )
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->carrierRepository
            ->findByBrandAndProxyTrunks(
                Argument::any(),
                Argument::any()
            )
            ->shouldNotBeCalled();

        $this->execute(
            $this->entity
        );
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
