<?php

namespace spec\Ivoz\Provider\Domain\Model\Friend;

use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use spec\HelperTrait;

class FriendSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var FriendDto
     */
    protected $dto;

    function let(
        CompanyInterface $company,
        DomainInterface $domain
    ) {

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
            ->setDirectConnectivity('yes');

        $this->hydrate(
            $dto,
            [
                'company' => $company->getWrappedObject()
            ]
        );

        $company
            ->getId()
            ->willReturn(1);

        $company
            ->getDomain()
            ->willReturn($domain);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
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
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());

        $dto->setName('$dollar');

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());

        $dto->setName('#something');

        $this
            ->shouldThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
    }

    function it_accepts_valid_names()
    {
        $dto = clone $this->dto;
        $dto->setName('MyFriend');

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($dto, new \spec\DtoToEntityFakeTransformer());
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
