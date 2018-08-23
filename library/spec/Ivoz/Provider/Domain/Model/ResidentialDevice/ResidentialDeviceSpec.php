<?php

namespace spec\Ivoz\Provider\Domain\Model\ResidentialDevice;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class ResidentialDeviceSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var ResidentialDeviceDto
     */
    protected $dto;

    /**
     * @var BrandInterface
     */
    protected $brand;


    function let(
        CompanyInterface $company,
        BrandInterface $brand
    ) {
        $this->dto = $dto = new ResidentialDeviceDto();
        $this->brand = $brand;

        $dto->setName('Name')
            ->setDescription('Desc')
            ->setTransport('udp')
            ->setAuthNeeded('yes')
            ->setDisallow('none')
            ->setAllow('all')
            ->setDirectMediaMethod('invite')
            ->setCalleridUpdateHeader('pai')
            ->setUpdateCallerid('yes')
            ->setDirectConnectivity('yes');

        $company
            ->getId()
            ->willReturn(1);

        $company
            ->getBrand()
            ->willReturn($brand);

        $this->hydrate(
            $dto,
            [
                'company' => $company->getWrappedObject()
            ]
        );

        $this->beConstructedThrough(
            'fromDto',
            [$dto]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ResidentialDevice::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['My Friend']);

        $this
            ->shouldThrow('\Exception')
            ->during('setName', ['$dollar']);
    }

    function it_accepts_valid_names()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setName', ['MyFriend']);
    }

    function it_throws_exception_on_invalid_ip()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['300.127.127.14']);

        $this
            ->shouldThrow('\Exception')
            ->during('setIp', ['aa:bb:cc:dd:ee:ff']);
    }

    function it_accepts_valid_ip()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['80.127.127.14']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['127.0.0.1']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['0.0.0.0']);

        $this
            ->shouldNotThrow('\Exception')
            ->during('setIp', ['2001:db8:a0b:12f0::1']);
    }

    function it_throws_an_exception_on_non_numeric_port()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPort', ['a3']);
    }

    function it_accepts_numeric_port()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPort', ['80']);
    }

    function it_throws_an_exception_on_invalid_password()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setPassword', ['1234']);
    }

    function it_accepts_format_compliant_password()
    {
        $this
            ->shouldNotThrow('\Exception')
            ->during('setPassword', ['HZhN5z*j48']);
    }

    function it_sets_domain(
        DomainInterface $domain
    )
    {
        $this->brand
            ->getId()
            ->willReturn(1);

        $this->brand
            ->getDomain()
            ->willReturn($domain);

        $this
            ->getDomain()
            ->shouldBe($domain);
    }
}
