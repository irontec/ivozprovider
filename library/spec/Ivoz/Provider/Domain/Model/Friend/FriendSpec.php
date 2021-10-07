<?php

namespace spec\Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class FriendSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var FriendDto
     */
    protected $dto;

    /**
     * @var DtoToEntityFakeTransformer
     */
    private $transformer;

    function let(
        CompanyInterface $company,
        DomainInterface $domain
    ) {
        $domainDto = new DomainDto();
        $domain = $this->getInstance(
            Domain::class
        );

        $companyDto = new CompanyDto();
        $company = $this->getterProphecy(
            $this->getTestDouble(Company::class),
            [
                'getId' => 1,
                'getDomain' => $domain,
            ]
        );

        $this->dto = $dto = new FriendDto();
        $dto->setName('Name')
            ->setDescription('Desc')
            ->setTransport('udp')
            ->setIp('1.2.3.4')
            ->setPort(5060)
            ->setPriority(1)
            ->setDisallow('all')
            ->setAllow('none')
            ->setDirectMediaMethod('invite')
            ->setCalleridUpdateHeader('rpid')
            ->setUpdateCallerid('yes')
            ->setDirectConnectivity('yes')
            ->setCompany($companyDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$companyDto, $company->reveal()],
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Friend::class);
    }

    function it_throws_exception_on_invalid_name()
    {
        $dto = clone $this->dto;
        $dto->setName('My Friend');

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);

        $dto->setName('$dollar');

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, new $this->transformer());

        $dto->setName('#something');

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
    }

    function it_accepts_valid_names()
    {
        $dto = clone $this->dto;
        $dto->setName('MyFriend');

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, $this->transformer);
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
            ->during('setPort', ['65536']);
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
}
