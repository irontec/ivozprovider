<?php

namespace spec\Ivoz\Provider\Domain\Model\WebPortal;

use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortal;
use Ivoz\Provider\Domain\Model\WebPortal\WebPortalDto;
use PhpSpec\ObjectBehavior;
use spec\DtoToEntityFakeTransformer;
use spec\HelperTrait;

class WebPortalSpec extends ObjectBehavior
{
    /**
     * @var WebPortalDto
     */
    protected $dto;

    use HelperTrait;

    function let(
        BrandInterface $brand
    ) {
        $brandDto = new BrandDto();
        $this->dto = $dto = new WebPortalDto();

        $dto->setUrl('https://something.net')
            ->setUrlType('user')
            ->setLogoFileSize(50)
            ->setLogoMimeType('')
            ->setLogoBaseName('logo.png')
            ->setBrand($brandDto);

        $transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $brand->getWrappedObject()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(WebPortal::class);
    }

    function it_throws_exception_on_invalid_url()
    {
        try {
            $this
                ->shouldThrow('\Exception')
                ->during('setUrl', ['something.net']);
        } catch (\Exception $e) {
        }

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

    function it_requires_brand_unless_god_type()
    {
        $fkTransformer = new DtoToEntityFakeTransformer();
        $this->hydrate(
            $this->dto,
            ['brand' => null]
        );

        $this->dto
            ->setUrlType('user');

        try {
            $this
                ->shouldThrow('\DomainException')
                ->duringUpdateFromDto($this->dto, $fkTransformer);
        } catch (\Exception $e) {
        }


        try {
            $this->dto
                ->setUrlType('admin');

            $this
                ->shouldThrow('\DomainException')
                ->duringUpdateFromDto($this->dto, $fkTransformer);
        } catch (\Exception $e) {
        }

        try {
            $this->dto
                ->setUrlType('brand');
            $this
                ->shouldThrow('\DomainException')
                ->duringUpdateFromDto($this->dto, $fkTransformer);
        } catch (\Exception $e) {
        }

        $this->dto
            ->setBrandId(null)
            ->setUrlType('god');

        $this
            ->shouldNotThrow('\Exception')
            ->duringUpdateFromDto($this->dto, $fkTransformer);
    }
}
