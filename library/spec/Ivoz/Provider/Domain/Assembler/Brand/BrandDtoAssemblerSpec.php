<?php

namespace spec\Ivoz\Provider\Domain\Assembler\Brand;

use Ivoz\Core\Domain\Service\CommonStoragePathResolver;
use Ivoz\Core\Domain\Service\StoragePathResolverCollection;
use Ivoz\Provider\Domain\Assembler\Brand\BrandDtoAssembler;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class BrandDtoAssemblerSpec extends ObjectBehavior
{
    protected $brand;

    function let(
        BrandInterface $brand,
        StoragePathResolverCollection $storagePathResolverCollection
    ) {
        $this->brand = $brand;
        $storagePathResolver = new CommonStoragePathResolver(
            '/opt/storage/',
            'ivozprovider_model_brands.logo'
        );

        $storagePathResolverCollection
            ->getPathResolver('Logo')
            ->willReturn($storagePathResolver);

        $this->beConstructedWith(
            $storagePathResolverCollection
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BrandDtoAssembler::class);
    }

    function it_should_do_nothing_with_no_id()
    {
        $dto = new BrandDto();
        $this
            ->brand
            ->getId()
            ->willReturn(null);

        $this
            ->brand
            ->toDto(0)
            ->willReturn($dto);

        $this
            ->toDto($this->brand)
            ->shouldReturn($dto);
    }

    function it_should_resolve_file_path_by_the_id()
    {
        $dto = new BrandDto();
        $this
            ->brand
            ->getId()
            ->willReturn(1);

        $this
            ->brand
            ->toDto(0)
            ->willReturn($dto);

        $logo = new \Ivoz\Provider\Domain\Model\Brand\Logo(
            1,
            'jpeg',
            'stuff.jpeg'
        );
        $this
            ->brand
            ->getLogo()
            ->willReturn($logo);

        $this->toDto($this->brand);
        $logoPath = $dto->getLogoPath();

        if ($logoPath !== '/opt/storage/ivozprovider_model_brands.logo/0/1') {
            throw new FailureException($logoPath);
        }
    }

    function it_creates_subpaths_for_long_ids()
    {
        $dto = new BrandDto();
        $this
            ->brand
            ->getId()
            ->willReturn(123456);

        $this
            ->brand
            ->toDto(0)
            ->willReturn($dto);

        $logo = new \Ivoz\Provider\Domain\Model\Brand\Logo(
            1,
            'jpeg',
            'stuff.jpeg'
        );

        $this
            ->brand
            ->getLogo()
            ->willReturn($logo);

        $this->toDto($this->brand);
        $logoPath = $dto->getLogoPath();

        if ($logoPath !== '/opt/storage/ivozprovider_model_brands.logo/1/2/3/4/5/123456') {
            throw new FailureException($logoPath);
        }
    }
}
