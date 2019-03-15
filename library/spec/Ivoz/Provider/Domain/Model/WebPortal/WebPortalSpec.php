<?php

namespace spec\Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use Ivoz\Provider\Domain\Model\WebPortal\Logo;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebPortalSpec extends ObjectBehavior
{
    protected $dto;

    function let()
    {

        $this->dto = $dto = new WebPortalDto();

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
        $this->shouldHaveType(WebPortal::class);
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
