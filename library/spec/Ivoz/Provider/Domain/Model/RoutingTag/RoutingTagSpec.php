<?php

namespace spec\Ivoz\Provider\Domain\Model\RoutingTag;

use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTagDto;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;
use spec\DtoToEntityFakeTransformer;

class RoutingTagSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var RoutingTagDto
     */
    protected $dto;

    protected $brand;

    private $transformer;

    function let()
    {
        $this->dto = $dto = new RoutingTagDto();
        $this->brand = $this->getTestDouble(
            BrandInterface::class,
            true
        );

        $brandDto = new BrandDto();

        $dto
            ->setName('Name')
            ->setTag('987#')
            ->setBrand($brandDto);

        $this->transformer = new DtoToEntityFakeTransformer([
            [$brandDto, $this->brand->reveal()]
        ]);

        $this->beConstructedThrough(
            'fromDto',
            [$dto, $this->transformer]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(RoutingTag::class);
    }

    function it_throws_exception_on_invalid_tag_format()
    {
        $validTags = [
            '1#', '12#', '123#'
        ];

        foreach ($validTags as $validTag) {
            $this
                ->dto
                ->setTag($validTag);

            $response = $this->updateFromDto(
                $this->dto,
                $this->transformer
            );

            $this
                ->getTag($validTag)
                ->shouldReturn($validTag);
        }

        $invalidTagd = [
            '123',
            '1234#'
        ];

        foreach ($invalidTagd as $invalidTag) {
            $this
                ->dto
                ->setTag($invalidTag);

            $this
                ->shouldThrow('\Exception')
                ->during(
                    'updateFromDto',
                    [
                        $this->dto,
                        $this->transformer
                    ]
                );
        }
    }
}
