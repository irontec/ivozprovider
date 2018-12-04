<?php

namespace spec\Ivoz\Provider\Domain\Model\BrandUrl;

use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrl;
use Ivoz\Provider\Domain\Model\BrandUrl\BrandUrlDto;
use Ivoz\Provider\Domain\Model\BrandUrl\Logo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BrandUrlSpec extends ObjectBehavior
{
    protected $dto;

    function let()
    {

        $this->dto = $dto = new BrandUrlDto();

        $dto->setUrl('https://something.net')
            ->setUrlType('user')
            ->setLogoFileSize(50)
            ->setLogoMimeType('')
            ->setLogoBaseName('logo.png');

        $this->beConstructedThrough(
            'fromDto',
            [$dto, new \spec\DtoToEntityFakeTransformer()]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BrandUrl::class);
    }

    function it_throws_exception_on_invalid_url()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setUrl', ['something.net']);

        $this
            ->shouldThrow('\Exception')
            ->during('setUrl', ['something']);
    }

    function it_throws_exception_on_http_url()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('setUrl', ['http://something.net']);
    }

    function it_accepts_valid_secure_urls()
    {
        $this
            ->shouldNotThrow('Exception')
            ->during('setUrl', ['https://something.net']);

        $this
            ->shouldNotThrow('Exception')
            ->during('setUrl', ['https://www.something.net']);
    }
}
